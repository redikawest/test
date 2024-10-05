<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function list(Request $request)
    {
        $data = Product::query()->paginate($request->limit ?? 20);

        return $data;
    }

    public function detail(int|string $id)
    {
        $data = Product::query()->findOrFail($id);
        
        return $data;
    }

    public function create(CreateProductRequest $request)
    {
        try {
            
            $data = new Product();

            $category = ProductCategory::find($request->categoryId);
            if (!$category) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Category Not Found',
                ]);
            }

            $data->name = $request->name;
            $data->description = $request->description;
            $data->categoryId = $request->categoryId;
            $data->stock = $request->stock;
            $data->category = $category->name;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
        
                $imageName = time() . '.' . $image->getClientOriginalExtension();
        
                $image->move(public_path('images'), $imageName);
        
                $data->image = $imageName;
            }
    
            $data->save();
    
            return response()->json([
                'code' => 200,
                'message' => 'Success Save Data',
            ]);

        } catch (\Exception $err) {
            Log::error($err);
            throw $err;
        }
    }

    public function update(int|string $id, UpdateProductRequest $request)
    {
        try {
            
            $data = Product::query()->findOrFail($id);

            $category = ProductCategory::find($request->categoryId);
            if (!$category) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Category Not Found',
                ]);
            }

            $data->name = $request->name;
            $data->description = $request->description;
            $data->categoryId = $request->categoryId;
            $data->stock = $request->stock;
            $data->category = $category->name;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
        
                $imageName = time() . '.' . $image->getClientOriginalExtension();
        
                $image->move(public_path('images'), $imageName);
        
                $data->image = $imageName;
            }

            $data->save();

            return response()->json([
                'code' => 200,
                'message' => 'Success update Data',
            ]);

        } catch (\Exception $err) {
            Log::error($err);
            throw $err;
        }
    }

    public function delete(int|string $id)
    {
        try {
            
            $data = Product::query()->findOrFail($id);
        
            $data->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Success Delete Data',
            ]);

        } catch (\Exception $err) {
            Log::error($err);
            throw $err;
        }
    }
}

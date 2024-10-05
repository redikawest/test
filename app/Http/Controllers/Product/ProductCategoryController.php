<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategory\CreateProductCategoryRequest;
use App\Http\Requests\ProductCategory\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function list(Request $request)
    {
        $data = ProductCategory::query()->paginate($request->limit ?? 20);

        return $data;
    }

    public function detail(int|string $id)
    {
        $data = ProductCategory::query()->findOrFail($id);
        
        return $data;
    }

    public function create(CreateProductCategoryRequest $request)
    {
        $data = new ProductCategory();

        $data->name = $request->name;
        $data->description = $request->description;

        $data->save();

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Data',
        ]);
    }

    public function update(int|string $id, UpdateProductCategoryRequest $request)
    {
        $data = ProductCategory::query()->findOrFail($id);

        $data->name = $request->name;
        $data->description = $request->description;

        $data->save();

        return response()->json([
            'code' => 200,
            'message' => 'Success update Data',
        ]);
    }

    public function delete(int|string $id)
    {
        $data = ProductCategory::query()->findOrFail($id);
        
        $data->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Success Delete Data',
        ]);
    }
}

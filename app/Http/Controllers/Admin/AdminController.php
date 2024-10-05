<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function list(Request $request)
    {
        $data = User::query()->paginate($request->limit ?? 20);

        return $data;
    }

    public function detail(int|string $id)
    {
        $data = User::query()->findOrFail($id);
        
        return $data;
    }

    public function create(CreateAdminRequest $request)
    {
        try {
            
            $data = new User();
    
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->email_verified_at = now();
            $data->birth_date = $request->birth_date;
            $data->gender = $request->gender;
            $data->password = bcrypt($request->password);
    
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

    public function update(int|string $id, CreateAdminRequest $request)
    {
        try {
            
            $data = User::query()->findOrFail($id);
    
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->email_verified_at = now();
            $data->birth_date = $request->birth_date;
            $data->gender = $request->gender;
            $data->password = bcrypt($request->password);
    
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
        $data = User::query()->findOrFail($id);
        
        $data->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Success Delete Data',
        ]);
    }
}

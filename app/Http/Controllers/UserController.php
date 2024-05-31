<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'sucess' => true,
            'message' => 'List All Users',
            'data' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'sucess' => false,
                'message' => $validation->errors(),
            ], 400);
        }

        
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        SendEmailJob::dispatch($user);

        return response()->json([
            'success' => true,
            'message' => 'Success Create User',
            'data' => $user,
        ]);
    }
}

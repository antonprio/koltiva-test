<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;

class CommentController
{
    public function index (Request $request)
    {
        $searchNameParam = $request->query('name');

        // If want to use dynamic name based on search in query param,
        $comments = User::with('comments')->where('name', 'LIKE', '%' . $searchNameParam . '%')->get();
        $koltiva = User::with('comments')->where('name', 'koltiva')->first();
        $result = [
            'koltiva' => $koltiva,
            'query_param' => $comments,
        ];

        return response()->json([
            'success' => true,
            'message' => 'List comments',
            'data' => $result,
        ]);
    }
}

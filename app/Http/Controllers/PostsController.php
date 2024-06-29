<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;

class PostsController extends Controller
{
    public function getPosts(){
        return response()->json([
            'data' => Posts::all()
        ], 200);
    }
}

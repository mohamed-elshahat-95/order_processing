<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function getPosts(){
        $recentPosts = Posts::selectRaw("id, title, LEFT(`description`, 512) as description, contact_phone_number, image, created_at, created_by")
        ->where('created_by', '!=', request()->user()->id)
        ->orderBy('created_at', 'desc')
        ->paginate(4);

        return response()->json([
            'data' => $recentPosts
        ], 200);
    }

    public function createPost(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'nullable|max:2048'
        ];
        $message = [
            'title.required' => "Sorry title Required",
            'description.max' => "description size needs to be not greater than 2048 char"
        ];
        $validate = Validator::make($request->all(), $rules,$message);
        if($validate->fails()){
            return response()->json([
                'message' => $validate->messages()->first()
            ], 400);
        }

        $post = new Posts;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->contact_phone_number = $request->contact_phone_number;
        $post->image = $request->image;
        $post->created_at = date("Y-m-d H:i:s");
        $post->created_by = $request->user()->id;
        $post->save();

        return response()->json([
            'status' => true,
            'msg' => 'create the post done successfully.'
        ]);
    }

    public function uploadImage($post_id, Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $filename);

        $post = Posts::find($post_id);
        $post->image = $filename;
        $post->save();

        return response()->json([
            'message' => 'upload image done successfully', 
            'filename' => $filename
        ], 200);
    }

    public function showPost($post_id)
    {
        $post = Posts::with('creator:id,name')->find($post_id);
       
        return response()->json([
            'data' => $post
        ], 200);
    }
}

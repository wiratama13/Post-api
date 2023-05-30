<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function get()
    {
        // $posts = Post::with('writer:id,email')->get();
        $posts = Post::all();

        // return response()->json([
        //     'message' => 'post berhasil didapat',
        //     'isi post' => $posts
        // ]);

        return PostDetailResource::collection($posts->loadMissing(['writer:id,email,name', 'comments:id,post_id,user_id,comments_content', 'categories:id,category']));
    }

    public function show($id)
    {
        $post = Post::with('writer:id,email,name')->findOrFail($id);

        // return new PostDetailResource($post);

        return new PostDetailResource($post->loadMissing(['writer:id,email,name', 'comments:id,post_id,user_id,comments_content', 'categories:id,category']));

        // return response()->json([
        //     'message' => 'data successfully fetched',
        //     'data' => $post
        // ]);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required',
            'news_content' => 'required',
            'categories_id' => 'numeric',
           
        ]);

        if ($validated->fails()) {
            return response()->json(
                $validated->errors(),
                402
            );
        }

        // $request['author'] = Auth::user()->id;
        $post = Post::create($request->all());
        return new PostDetailResource($post->loadMissing('writer:id','categories:id,category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'news_content' => 'required',
            'categories_id' => 'numeric',
        ]);

        $post = Post::findOrFail($id);

        $post->update($request->all());

        return response()->json([
            "data" => $post
        ]);
    }

    public function delete($id)
    {
        $posts = Post::findOrFail($id);
        $posts->delete();

        return response()->json([
            "message" => "berhasil dihapus",
            "data" => $posts
        ]);
    }
}

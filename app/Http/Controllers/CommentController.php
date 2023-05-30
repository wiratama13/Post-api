<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required',
            'comments_content' => 'required'
        ]);

        $request['user_id'] = auth()->user()->id;
        
        $comments = Comment::create($request->all());

        // return response()->json([
        //     "message" => "success",
        //     "data" => $comments->loadMissing(['userComment'])
        // ]);

        return new CommentResource($comments->loadMissing(['userComment:id,email,name']));

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'comments_content' => 'required'
        ]);

        $comments = Comment::findOrFail($id);

        $comments->update($request->only('comments_content'));

        // return response()->json([
        //     "message" => "data update successfully",
        //     "data" => $comment
        // ]);
        return new CommentResource($comments->loadMissing(['userComment:id,email,name']));
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json([
            "message" => "commment berhasil dihapus",
            "data" => $comment
        ]);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Comment;

class CommentOwn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user()->id;
        $comment = Comment::findOrFail($request->id);
       
        if($comment->user_id != $user)
        {
            return response()->json([
                "message" => "Data Not Found"
            ], 404);
        }

        return $next($request);
    }
}

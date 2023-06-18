<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CreateCommentRequest $request,$eventId){
$newComment = new Comment();
$newComment -> body = $request->body;
$newComment->user_id = auth()->user()->id;
$newComment->event_id = $eventId;
$newComment->save();

$comment = Comment::with('user')->find($newComment->id);
return $comment;

    }

    public function destroy ($id){
        $comment = Comment::find($id);
        $comment ->delete();
        return response()->json([
            'message' =>'Deleted'
        ]);

    }
}
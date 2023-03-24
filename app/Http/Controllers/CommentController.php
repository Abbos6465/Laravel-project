<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
   
    public function index()
    {
        
    }

    
    public function create()
    {
        
    }

    public function store(Request $request)
    {
        

       $comment = Comment::create([
            'body'=>$request->body,
            'post_id'=>$request->post_id,
            'user_id'=>auth()->id(),
       ]);

       return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment,Post $post)
    {
        $this->authorize('update',$comment);

        return view('comments.edit')->with(['comment'=>$comment,'post'=>$post]);
    }

    
    public function update(Request $request, Comment $comment,Post $post)
    {
        $this->authorize('update',$comment);
        $comment->update([
            'body'=>$request->body,
            'post_id'=>$request->post_id,
            'user_id'=>auth()->id(),
       ]);

       return redirect()->action([PostController::class, 'show'],['post'=>$comment->post->id]);
       }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete',$comment);
        $comment->delete();
        return redirect()->back();

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Post $post)
    {
        // return $post->all();
        return PostResource::collection($post->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('post-photos');
        }

        $post = Post::create([
            'user_id' => 1,
            'title' => $request->title,
            'category_id' => $request->category_id,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? null,

        ]);

        if (isset($request->tags)) {
            foreach ($request->tags as $tag) {
                $post->tags()->attach($tag);
            }
        }
    
        return response(["success"=>"Post yaratildi"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return "deleted";
    }
}

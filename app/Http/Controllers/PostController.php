<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Requests\StorePostRequest;
use App\Jobs\ChangePost;
use App\Mail\PostCreated as MailPostCreated;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Notifications\PostCreated as NotificationsPostCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
        $this->middleware('password.confirm')->only('edit');
    }

    public function index()
    {
        $posts = Post::latest()->paginate(9);

        return view('posts.index')->with('posts', $posts);
    }


    public function create()
    {
        return view('posts.create')->with(['categories' => Category::all(), 'tags' => Tag::all()]);
    }


    public function store(StorePostRequest $request)
    {
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('post-photos');
        }

        $post = Post::create([
            'user_id' => $request->user()->id,
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

        PostCreated::dispatch($post);

        ChangePost::dispatch($post);

        Mail::to($request->user())->queue((new MailPostCreated($post))->onQueue('sending_mails'));
        
        FacadesNotification::send(auth()->user(), new NotificationsPostCreated($post));

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post,
        'recent_posts' => Post::latest()->get()->except($post->id)->take(5),
        'tags'=>Tag::all(),
        'categories'=>Category::all(),
         ]);
    }


    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit')->with('post', $post);
    }


    public function update(StorePostRequest $request, Post $post)
    {

        $this->authorize('update', $post);

        if ($request->hasFile('photo')) {
            if (isset($post->photo)) {
                Storage::delete($post->photo);
            }

            $path = $request->file('photo')->store('post-photos');
        }

        $post->update([
            'title' => $request->title,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? $post->photo,
        ]);

        return redirect()->route('posts.index');
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        if (isset($post->photo)) {
            Storage::delete($post->photo);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}

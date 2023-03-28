<x-layouts.app>
    <x-slot:title>
        Post - {{$post->id}}
        </x-slot>
        <x-page-header>
            Post - {{$post->id}}
        </x-page-header>

        <!-- Detail Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        @auth
                        @canany(['update','delete'],$post)
                        <div class="d-flex justify-content-end gap-4">
                            <a href="{{route('posts.edit',['post'=>$post->id])}}" class="btn btn-sm btn-primary">O'zgartirish</a>
                            <form action="{{route('posts.destroy',['post'=>$post->id])}}" method="POST" onsubmit="return confirm('Siz rostdan ham bu postni o\'chirmoqchimisiz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">O'chirish</button>
                            </form>
                        </div>
                        @endcanany
                        @endauth
                        <div class="mb-5">
                            <div class="d-flex mb-2 flex-wrap mt-5 w-100">
                                @foreach ($post->tags as $tag)
                                <span class="text-secondary text-uppercase font-weight-medium" href="">{{$tag->name}}</span>
                                <span class="text-primary px-2">|</span>
                                @endforeach
                                <br>
                                <span class="text-primary">{{$post->created_at}}</span>
                            </div>
                            <div class="d-flex mb-2">
                                <h5 class="bg-success text-white p-2 rounded">{{$post->category->name}}</h5>
                            </div>
                            <h1 class="section-title mb-3">{{$post->title}}</h1>
                        </div>
                        <div class="mb-5">
                            <img src="@if ($post->photo)
                            {{asset('storage/'.$post->photo)}}
                            @else
                            /img/portfolio-1.jpg
                            @endif"  alt="default img" width="500">
                        </div>
                        <div class="mb-5">
                            <p>{{$post->content}}</p>
                        </div>
                        <div class="mb-5">
                            <h3 class="mb-4 section-title">{{$post->comments()->count()}} Izohlar</h3>
                            @foreach ($post->comments as $comment)

                            <div class="media mb-4">
                                <img src="/img/user.jpg" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px;">
                                <div class="media-body">
                                    <h6>{{$comment->user->name}} <small><i>{{$comment->created_at}}</i></small></h6>
                                    <p>{{$comment->body}}</p>
                                    @auth
                                    @canany(['update','delete'],$comment)
                                    <div class="btn-group" role="group">
                                        <a href="{{route('comment.edit',['comment'=>$comment->id])}}" class="btn btn-sm btn-outline-info rounded-left">O'zgartirish</a>
                                        <form action="{{route('comment.destroy',['comment'=>$comment->id])}}" method="POST">
                                            <div class="btn-group">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger rounded-right">O'chirish</button>
                                            </div>
                                        </form>
                                    </div>
                                    @endcanany
                                    @endauth
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="bg-light rounded p-5">
                            <h3 class="mb-4 section-title">Izoh qoldirish</h3>
                            @auth
                            <form action="{{route('comment.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="message">Xabar *</label>
                                    <textarea id="message" required='required' cols="30" rows="5" name="body" class="form-control"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <input type="submit" value="Izoh qoldirish" class="btn btn-primary">
                                </div>
                            </form>
                            @else
                            <h4 class="text-primary">Izoh qoldirish uchun ro'yxatdan o'ting yoki kiring</h4>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('register')}}" class="btn btn-outline-secondary">Ro'yxatdan o'tish</a>
                                <a href="{{route('login')}}" class="btn btn-outline-info">Kirish</a>
                            </div>
                            @endauth
                        </div>
                        
                    </div>

                    <div class="col-lg-4 mt-5 mt-lg-0">
                        <div class="d-flex flex-column text-center bg-secondary rounded mb-5 py-5 px-4">
                            <img src="/img/user.jpg" class="img-fluid rounded-circle mx-auto mb-3" style="width: 100px;">
                            <h3 class="text-white mb-3">{{$post->user->name}}</h3>
                            <p class="text-white m-0">Conset elitr erat vero dolor ipsum et diam, eos dolor lorem ipsum,
                                ipsum
                                ipsum sit no ut est. Guber ea ipsum erat kasd amet est elitr ea sit.</p>
                        </div>
                        <div class="mb-5">
                            <div class="w-100">
                                <div class="input-group">
                                    <input type="text" class="form-control" style="padding: 25px;" placeholder="Keyword">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary px-4">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <h3 class="mb-4 section-title">Categories</h3>
                            <ul class="list-inline m-0">
                                @foreach ($categories as $category)
                                <li class="mb-1 py-2 px-3 bg-light d-flex justify-content-between align-items-center">
                                    <a class="text-dark" href="#"><i class="fa fa-angle-right text-secondary mr-2"></i>{{$category->name}}</a>
                                    <span class="badge badge-primary badge-pill">{{$category->posts()->count()}}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="mb-5">
                            <h3 class="mb-4 section-title">Tag Cloud</h3>
                            <div class="d-flex flex-wrap m-n1">
                                @foreach ($tags as $tag)
                                <a href="" class="btn btn-outline-secondary m-1">{{$tag->name}}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-5">
                            <img src="/img/blog-1.jpg" alt="" class="img-fluid rounded">
                        </div>
                        <div class="mb-5">
                            <h3 class="mb-4 section-title">Recent Post</h3>
                            @foreach ($recent_posts as $post)
                            <div class="d-flex align-items-center border-bottom mb-3 pb-3">
                                <img class="img-fluid rounded" src="{{asset('storage/' . $post->photo)}}" style="width: 80px; height: 80px; object-fit: cover;" alt="">
                                <div class="d-flex flex-column pl-3">
                                    <a class="text-dark mb-2" href="">{{$post->title}}</a>
                                    <div class="d-flex">
                                        <small><a class="text-secondary text-uppercase font-weight-medium" href="">Admin</a></small>
                                        <small class="text-primary px-2">|</small>
                                        <small><a class="text-secondary text-uppercase font-weight-medium" href="">Cleaning</a></small>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Detail End -->


</x-layouts.app>
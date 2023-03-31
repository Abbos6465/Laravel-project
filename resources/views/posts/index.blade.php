<x-layouts.app>
    <x-slot:title>
        {{__("Blog")}}
        </x-slot>

        <x-page-header>
            {{__("Blog")}}
        </x-page-header>

        <!-- Blog Start -->
        <div class="container-fluid py-5">
            <div class="container">
                @if (session('success'))
                <div class="alert alert-success mb-5" role="alert">
                    <h2 class="text-center text-success">{{__("Post Yaratildi")}}</h2>
                </div>
                @endif
                <div class="row align-items-end mb-4">
                    <div class="col-lg-6">
                        <h6 class="text-secondary font-weight-semi-bold text-uppercase mb-3">Latest Blog</h6>
                        <h1 class="section-title mb-3">Oxirgi postlar</h1>
                    </div>
                </div>
                <div class="row">
                    @foreach ($posts as $post)

                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="position-relative mb-4">
                            <img class="img-fluid rounded w-100" src="@if ($post->photo)
                            {{asset('storage/'.$post->photo)}}
                            @else
                            /img/portfolio-1.jpg
                            @endif" alt="rasm">
                            <div class="blog-date">
                                <h4 class="font-weight-bold mb-n1">01</h4>
                                <small class="text-white text-uppercase">Jan</small>
                            </div>
                        </div>

                        <div class="d-flex mb-2 flex-wrap">
                            @foreach ($post->tags as $tag)
                            <span class="text-secondary text-uppercase font-weight-medium" href="">{{$tag->name}}</span>
                            @if($loop->iteration!=$loop->last)
                            <span class="text-primary px-2">|</span>
                            @endif
                            @endforeach
                        </div>
                        <div class="d-flex mb-2">
                            <span class="text-danger text-uppercase font-weight-medium">{{$post->category->name}}</span>
                        </div>
                        <h5 class="font-weight-medium mb-2">{{$post->title}}</h5>
                        <p class="mb-4">{{$post->short_content}}</p>
                        <a class="btn btn-sm btn-primary py-2" href="{{route('posts.show',['post'=>$post->id])}}">Read More</a>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="mx-auto d-flex justify-content-center">
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog End -->



</x-layouts.app>
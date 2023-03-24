<x-layouts.app>
    <x-slot:title>
        Edit post - {{$post->id}}
        </x-slot>

        <x-page-header>
            Edit post - {{$post->id}}
        </x-page-header>

        <div class="container">
            <div class="mx-auto p-5 my-5">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card p-5 shadow rounded-1">
                    <form action="{{route('posts.update',['post'=>$post->id])}}" method="POST" enctype="multipart/form-data">
                        @method('PUT') 
                        @csrf
                        <input type="text" class="form-control w-75 mx-auto"  placeholder="Sarlavha" name="title" value="{{$post->title}}">
                        <textarea class="form-control p-4 w-75 mx-auto mt-3" rows="3" placeholder="Qisqacha mazmuni" name="short_content">{{$post->short_content}}</textarea>
                        <textarea class="form-control p-4 w-75 mx-auto mt-3" rows="6" placeholder="Ma'qola" name="content">{{$post->content}}</textarea>
                        <input type="file" class="form-control w-75 mx-auto mt-3" name="photo" value="{{$post->photo}}" />
                        <button class="btn btn-warning w-50 mx-auto d-block mt-3" type="submit">O'zgartirish</button>
                    </form>
                </div>
            </div>
        </div>

</x-layouts.app>
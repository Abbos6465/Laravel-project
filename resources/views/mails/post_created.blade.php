<div>
    <h1>Hurmatli {{ $post->user->name }}!</h1>
    <h5>Siz {{ $post->created_at }} da yangi post yaratdingiz</h5>
    <div>Post id: <strong>{{ $post->id }}</strong></div>
    <div>{{ $post->title }}</div>
    <div>{{$post->short_content}}</div>
    <div>{{$post->content}}</div>
    <div>{{$post->photo}}</div>
    <strong>Raxmat</strong>
</div>
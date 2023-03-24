<x-layouts.app>
    <x-slot:title>
        Comment- {{$comment->id}} edit
    </x-slot:title>
    <div class="container my-5">
    <div class="bg-light rounded p-5">
                            <h3 class="mb-4 section-title">Izoh O'zgartirish</h3>
                            @auth
                            <form action="{{route('comment.update',['comment'=>$comment->id])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="message">Xabar *</label>
                                    <textarea id="message" required='required' cols="30" rows="5" name="body" class="form-control">{{$comment->body}}</textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <input type="hidden" name="post_id" value="{{$comment->post->id}}">
                                  
                                    <input type="submit" value="Izoh o'zgartirish" class="btn btn-primary">
                                </div>
                            </form>
                            @endauth
                        </div>
    </div>
</x-layouts.app>
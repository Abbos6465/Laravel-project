<x-layouts.app>
    <x-slot:title>
        Xabarnomalar
        </x-slot>

        <x-page-header>
            Xabarnomalar
        </x-page-header>

        <!-- Blog Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="d-flex align-items-end justify-content-between mb-5">
                    <div class="">
                        <h1 class="section-title mb-3">Xabarnomalar</h1>
                    </div>
                    <div>
                        <a href="{{ route('readAll' , ['notifications'=>$notifications->pluck('id')]) }}" class="btn btn-success">Barchasini o'qish</a>
                    </div>
                </div>
                @foreach ($notifications as $notification)
                <div class="col-lg-12 col-md-12 mb-5 rounded border pb-2">
                    <div class="mb-2">
                        @if ($notification->read_at===null)
                        <div class="blog-date">
                            <h4 class="font-weight-bold mb-1 text-light">
                                <span>New</span>
                            </h4>
                        </div>
                        @else
                            <h4 class="d-flex justify-content-end">
                                <form action="{{route('notification.destroy',['notification'=>$notification->id])}}" method="POST">
                                    @csrf
                                    <button class="text-danger border-warning bg-warning">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </h4>
                            @endif
                    </div>

                    <div class="d-flex mb-2">
                        <span class="text-danger text-uppercase font-weight-medium">{{$notification->created_at}}</span>
                    </div>
                    <h5 class="font-weight-medium mb-2">{{$notification->data['title']}}</h5>
                    <p class="mb-4">{{"Post yaratildi. Id:" . $notification->data['id']}}</p>
                    @if ($notification->read_at===null)
                    <a class="btn btn-sm btn-primary py-2" href="{{ route('read' , ['notification'=>$notification->id]) }}">O'qildi</a>
                    @endif
                </div>
                @endforeach



                <div class="row">
                    <div class="mx-auto d-flex justify-content-center">
                        {{$notifications->links()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog End -->



</x-layouts.app>
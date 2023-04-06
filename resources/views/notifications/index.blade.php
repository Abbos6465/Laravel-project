<x-layouts.app>
    <x-slot:title>
        {{__("Xabarnomalar")}}
        </x-slot>

        <x-page-header>
        {{__("Xabarnomalar")}}
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
                <div class="mb-5 rounded border py-2 pe-2 ps-4">
                    <div class="mb-2">
                        @if ($notification->read_at===null)
                            <h4 class="d-flex justify-content-end rounded">
                                <span class="bg-warning text-success p-2 rounded">New</span>
                            </h4>
                        @else
                        <h4 class="d-flex justify-content-end">
                            <form action="{{route('notification.destroy',['notification'=>$notification->id])}}" method="POST">
                                @csrf
                                <button class="text-danger border-warning bg-warning p-2 rounded">
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
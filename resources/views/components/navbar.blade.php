<nav class="navbar navbar-expand-lg bg-white navbar-light p-0">
    <a href="" class="navbar-brand d-block d-lg-none">
        <h1 class="m-0 display-4 text-primary">Klean</h1>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0">
            <a href="/" class="nav-item nav-link">{{__("Bosh sahifa")}}</a>
            <a href="{{route('about')}}" class="nav-item nav-link">{{__("Biz haqimizda")}}</a>
            <a href="{{route('service')}}" class="nav-item nav-link">{{__("Xizmatlar")}}</a>
            <a href="{{route('project')}}" class="nav-item nav-link">{{__("Portfolio")}}</a>
            <a href="{{route('posts.index')}}" class="nav-item nav-link">{{__("Blog")}}</a>
            <a href="{{route('contact')}}" class="nav-item nav-link">{{__("Aloqa")}}</a>
        </div>
        <div class="d-flex">
            <form action="{{route('change_locale')}}" method="POST">
                @csrf
                <select name="change_locale" class="form-select text-uppercase"  onchange="this.form.submit()" >
                    <option value="{{$current_locale}}">{{$current_locale}}</option>
                    @foreach ($all_locales as $lang)
                    @if($lang==$current_locale)
                    @continue
                    @endif
                    <option value="{{$lang}}">
                        {{$lang}}
                    </option>
                    @endforeach
                </select>
            </form>
        </div>
        @auth
        @if (auth()->user()->unreadNotifications()->count()>0)
        <div class="position-relative">
            <a href="{{route('notifications.index')}}" class="btn btn-outline-secondary w-50 d-flex mx-auto rounded-7 justify-content-center">
                <i class="bi bi-bell fs-5"></i>
            </a>
            <span class="position-absolute bg-light fs-5 px-2 rounded-5 top-0 end-0 text-dark">
                {{ auth()->user()->unreadNotifications()->count() }}
            </span>
        </div>
        @endif
        <a href="{{route('posts.create')}}" class="btn btn-primary ms-2  me-3 d-block">{{__("Post yaratish")}}</a>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-dark mr-3 d-none d-lg-block">{{__("Chiqish")}}</button>
        </form>
        @else
        <a href="{{route('login')}}" class="btn btn-primary mr-3 d-none d-lg-block">{{__("Kirish")}}</a>
        @endauth
    </div>
</nav>
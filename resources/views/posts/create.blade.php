<x-layouts.app>
    <x-slot:title>
            {{__("Post yaratish")}} 
        </x-slot>
        <x-page-header>
            {{__("Post yaratish")}}
        </x-page-header>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mb-5 mb-lg-0 mx-auto">
                    <!-- /resources/views/post/create.blade.php -->

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Create Post Form -->
                    <div class="contact-form">
                        <div id="success"></div>
                        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="control-group">
                                <input type="text" class="form-control p-4" placeholder="Sarlavha" name="title" value="{{old('title')}}" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <label class="form-label ps-5">Select a category</label>
                                <select name="category_id" class="form-select w-100 d-block p-2 rounded-pill">
                                @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <label class="fom-label">Select a tag</label>
                            <select name="tags[]" class="w-100 d-block p-2 rounded" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control p-4" rows="3" placeholder="Qisqacha mazmuni" name="short_content">{{old('short_content')}}</textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control p-4" rows="6" placeholder="Ma'qola" name="content">{{old('content')}}</textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="file" class="form-control p-4 mb-4" name="photo" value="{{old('photo')}}" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block py-3 px-5" type="submit" id="sendMessageButton">{{__("Saqlash")}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-layouts.app>



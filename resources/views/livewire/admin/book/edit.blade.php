<div>
    <div class="container mt-4">
        <div class="card ms-4 me-4 rounded-3 mb-4" style="border: none">
            <div class="card-body">
                <div>
                    <h2><b>Edit Book</b></h2>
                </div>
                <hr>
                <div>
                    <form wire:submit="update">
                        <div class="row">
                            <div class="col-4">
                                <div class="text-center">
                                    <img src="{{env('FAST_API_URL')}}/train_images/{{$prev_image}}" alt="" style="width: 250px; height: 350px" class="rounded-3">
                                </div>
                                <div class="mt-4">
                                    <x-file-pond wire:model.blur="image"
                                                 allowImageEdit
                                                 allowImagePreview
                                                 imagePreviewMaxHeight="300"
                                                 allowFileTypeValidation
                                                 acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                                                 allowFileSizeValidation
                                                 maxFileSize="10mb" />
                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" wire:model.live="title">
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('category') is-invalid @enderror" placeholder="Category" disabled wire:model.blur="category">
                                        <button class="btn" type="button" style="background-color: #008797; color: white;" wire:click="generateCategory" @if(!$title) disabled @endif>Generate</button>
                                        @error('category')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div wire:loading wire:target="generateCategory">
                                        Generating category...
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label class="form-label">Author</label>
                                    @foreach($authors as $index => $author)
                                        <div class="input-group">
                                            <input type="text" class="form-control mt-1 @error('authors.'.$index.'.name') is-invalid @enderror" placeholder="Author" wire:model.blur="authors.{{$index}}.name">
                                            @if($index > 0 && $loop->last)
                                                <button wire:click="delete_authors({{$index}})" class="btn mt-1" type="button" style="background-color: #008797; color: white;">X</button>
                                            @endif
                                            @error('authors.'.$index.'.name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                    @endforeach
                                    <button wire:click="add_authors" class="btn float-end mt-2" type="button" style="background-color: #008797; color: white;">
                                        Add Author
                                    </button>
                                </div>
                                <div class="mb-3 mt-5">
                                    <label class="form-label">Published Date</label>
                                    <input type="date" class="form-control @error('published') is-invalid @enderror" wire:model.blur="published">
                                    @error('published')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Available</label>
                                    <select class="form-select @error('available') is-invalid @enderror" wire:model.blur="available">
                                        <option value="">Select</option>
                                        @php
                                            $values = [true => 'Yes', false => 'No'];
                                        @endphp
                                        @foreach($values as $key => $label)
                                            <option value="{{$key}}">{{$label}}</option>
                                        @endforeach
                                    </select>
                                    @error('available')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button class="btn rounded-3 w-100" type="submit" style="background-color: #008797; color: white;">Edit Book</button>
                                    <button class="btn rounded-3 w-100 mt-2 btn-danger" type="button" wire:confirm="are you sure want to delete this book?" wire:click="deleteBook">Delete Book</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
{{--        <a href="{{route('admin.book.index')}}" wire:navigate>Back</a>--}}
{{--        <hr>--}}
{{--        <form wire:submit="update">--}}
{{--            <img src="{{env('FAST_API_URL')}}/train_images/{{$prev_image}}" alt="" style="width: 300px; height: 400px">--}}
{{--            <br>--}}
{{--            <div class="mt-2">--}}
{{--                @if($image)--}}
{{--                    <img src="{{$image->temporaryUrl()}}" style="width: 300px; height: 400px">--}}
{{--                @endif  --}}
{{--                <input type="file" wire:model.blur="image" accept="image/*">--}}
{{--                @error('image')--}}
{{--                {{$message}}--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <br><br>--}}
{{--            <input type="text" wire:model.blur="title" placeholder="Title" size="50">--}}
{{--            @error('title')--}}
{{--            {{$message}}--}}
{{--            @enderror--}}
{{--            <input type="text" wire:model.blur="category" placeholder="Category" disabled size="25">--}}
{{--            @error('category')--}}
{{--            {{$message}}--}}
{{--            @enderror--}}
{{--            <button wire:click="generateCategory" type="button">Generate</button>--}}
{{--            <div wire:loading wire:target="generateCategory">--}}
{{--                Generating category...--}}
{{--            </div>--}}
{{--            <input type="date" wire:model.blur="published">--}}
{{--            @error('published')--}}
{{--            {{$message}}--}}
{{--            @enderror--}}
{{--            <br>--}}
{{--            <div class="mt-2">--}}
{{--                @foreach($authors as $index => $author)--}}
{{--                    <input type="text" wire:model.blur="authors.{{$index}}.name" placeholder="Author" size="25">--}}
{{--                    @error('authors.'.$index.'.name')--}}
{{--                    {{$message}}--}}
{{--                    @enderror--}}
{{--                    @if($index > 0 && $loop->last)--}}
{{--                        <button wire:click="deleteAuthors({{$index}})" type="button">X</button>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--                <button wire:click="addAuthors" type="button">Add Authors</button>--}}
{{--            </div>--}}
{{--            <label for="">Available</label>--}}
{{--                <select wire:model.blur="available">--}}
{{--                    <option value="">Select</option>--}}
{{--                    @php--}}
{{--                        $values = [true => 'Yes', false => 'No'];--}}
{{--                    @endphp--}}
{{--                    @foreach($values as $key => $label)--}}
{{--                        <option value="{{$key}}">{{$label}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            @error('available')--}}
{{--                {{$message}}--}}
{{--            @enderror--}}
{{--            <button type="submit" class="mt-4">Edit Book</button>--}}
{{--            <button type="button" wire:confirm="are you sure want to delete this book?" wire:click="deleteBook">Delete Book</button>--}}
{{--        </form>--}}
    </div>
</div>

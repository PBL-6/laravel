<div>
    <div class="container mt-4">
        <a href="{{route('admin.book.index')}}" wire:navigate>Back</a>
        <hr>
        <form wire:submit="update">
            <img src="{{env('FAST_API_URL')}}/train_images/{{$prev_image}}" alt="" style="width: 300px; height: 400px">
            <br>
            <div class="mt-2">
                @if($image)
                    <img src="{{$image->temporaryUrl()}}" style="width: 300px; height: 400px">
                @endif
                <input type="file" wire:model.blur="image" accept="image/*">
                @error('image')
                {{$message}}
                @enderror
            </div>

            <br><br>
            <input type="text" wire:model.blur="title" placeholder="Title" size="50">
            @error('title')
            {{$message}}
            @enderror
            <input type="text" wire:model.blur="category" placeholder="Category" disabled size="25">
            @error('category')
            {{$message}}
            @enderror
            <button wire:click="generateCategory" type="button">Generate</button>
            <div wire:loading wire:target="generateCategory">
                Generating category...
            </div>
            <input type="date" wire:model.blur="published">
            @error('published')
            {{$message}}
            @enderror
            <br>
            <div class="mt-2">
                @foreach($authors as $index => $author)
                    <input type="text" wire:model.blur="authors.{{$index}}.name" placeholder="Author" size="25">
                    @error('authors.'.$index.'.name')
                    {{$message}}
                    @enderror
                    @if($index > 0 && $loop->last)
                        <button wire:click="deleteAuthors({{$index}})" type="button">X</button>
                    @endif
                @endforeach
                <button wire:click="addAuthors" type="button">Add Authors</button>
            </div>
            <label for="">Available</label>
                <select wire:model.blur="available">
                    <option value="">Select</option>
                    @php
                        $values = [true => 'Yes', false => 'No'];
                    @endphp
                    @foreach($values as $key => $label)
                        <option value="{{$key}}">{{$label}}</option>
                    @endforeach
                </select>
            @error('available')
                {{$message}}
            @enderror
            <button type="submit" class="mt-4">Edit Book</button>
            <button type="button" wire:confirm="are you sure want to delete this book?" wire:click="deleteBook">Delete Book</button>
        </form>
    </div>
</div>

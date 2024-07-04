<div>
    <div class="container mt-4">
        <a href="{{route('admin.book.index')}}" wire:navigate>Back</a>
        <hr>
        <form wire:submit="update">
            <input type="text" wire:model.blur="title" placeholder="Title">
            @error('title')
            {{$message}}
            @enderror
            <input type="text" wire:model.blur="category" placeholder="Category" disabled>
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
                    <input type="text" wire:model.blur="authors.{{$index}}.name" placeholder="Author">
                    @error('authors.'.$index.'.name')
                    {{$message}}
                    @enderror
                    @if($index > 0 && $loop->last)
                        <button wire:click="deleteAuthors({{$index}})" type="button">X</button>
                    @endif
                @endforeach
                <button wire:click="addAuthors" type="button">Add Authors</button>
            </div>
            <br>
            @if($image)
                <img src="{{$image->temporaryUrl()}}" style="width: 300px; height: 400px">
            @endif
            <input type="file" wire:model.blur="image" accept="image/*">
            @error('image')
            {{$message}}
            @enderror
            <br>
            <button type="submit" class="mt-4">Edit Book</button>
            <button type="button" wire:confirm="are you sure want to delete this book?" wire:click="deleteBook">Delete Book</button>
        </form>
    </div>
</div>

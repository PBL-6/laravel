<div>
    <div class="container text-center mt-4">
        <a href="{{route('home')}}" wire:navigate class="btn btn-secondary">Home</a>
        <button type="button" wire:click="toggleUpload" class="btn btn-primary">Upload Book Cover</button>
        <hr>
        @if($isUpload)
            <div class="mt-4">
                <form wire:submit="search">
                    @if($image)
                        <img src="{{$image->temporaryUrl()}}" alt="" height="200" width="150" class="mb-4">
                    @endif
                    <input type="file" class="form-control" wire:model.blur="image" style="display: {{$isUpload ? 'block' : 'none'}}" accept="image/*">
                    @error('image')
                    {{$message}}
                    @enderror
                    <button type="submit" class="btn btn-secondary mt-4" wire:loading.attr="disabled" wire:target="image">Search book</button>
                </form>
            </div>
        @endif
        @if($isNotFound)
            <div class="mt-4">
                <img src="http://127.0.0.1:8000/query_images/{{$query_image_name}}" height="200" width="150" class="mt-2">
                <div class="text-center mt-4 mb-4">
                    <b class="text-danger">Book Not Found!</b>
                </div>
            </div>
        @endif
    </div>
</div>



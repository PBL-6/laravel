<div>
    <div class="container">
        <div class="mt-3 text-center">
            <div class="row">
                <div class="col-12">
                    <a href="/" class="btn btn-secondary">Home</a>
                </div>
            </div>
            <form wire:submit="saveUploadBook" class="border mt-3 mb-3 rounded-3">
                <div class="container">
                    <div class="text-center">
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="mt-3 img-thumbnail" height="200" width="150">
                        @endif
                        <input type="file" wire:model="image" class="mt-3 form-control @error('image') is-invalid @enderror rounded-3" id="{{$file_iteration}}" accept="image/*">
                        @error('image')
                        <div class="text-danger mb-2"><small>{{ $message }}</small></div>
                        @enderror
                        <button type="submit" class="btn btn-primary w-100 mt-2 rounded-3 mb-2">Upload image</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

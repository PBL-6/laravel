<div>
    <div class="container mt-5">
        @if($isNotFound)
            <h1 class="fw-bold text-dark">
                Search Result
            </h1>
            <div class="text-center">
                <div style="height: 100%; border: 2px dashed #ccc;" class="mt-4 rounded-3">
                    <div class="mt-4 mb-4 me-4 ms-4">
                        <div class="mt-4">
                            <img src="{{env('FAST_API_URL')}}/query_images/{{$query_image_name}}" height="200" width="150" class="rounded-3">
                        </div>
                        <div class="text-danger mt-3">
                            <b>
                                Book Not Found!
                            </b>
                        </div>
                    </div>
                </div>
                <a href="{{route('search')}}" wire:navigate class="btn mt-3 mb-4" style="background-color: #008797; color: white;">
                    Back
                </a>
            </div>
        @else
            <h1 class="fw-bold text-dark">
                Upload Cover Book
            </h1>
            <form wire:submit="search" class="text-center">
                <div style="height: 100%; border: 2px dashed #ccc;" class="mt-4 rounded-3">
                    <div class="mt-4 mb-4 me-4 ms-4">
                        <x-file-pond wire:model.blur="image"
                                     allowImageEdit
                                     allowImagePreview
                                     imagePreviewMaxHeight="250"
                                     allowFileTypeValidation
                                     acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                                     allowFileSizeValidation
                                     maxFileSize="10mb" />
                    </div>
                </div>
                @error('image')
                <div class="text-danger mt-2 mb-2">
                    {{$message}}
                </div>
                @enderror
                <button type="submit" class="btn mt-2 mb-4" wire:loading.attr="disabled" wire:target="image" style="background-color: #008797; color: white;">
                    <span wire:loading wire:target="search">
                        <div class="spinner-border spinner-border-sm me-1" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                    </span>
                    Search
                </button>
            </form>
        @endif
    </div>
</div>



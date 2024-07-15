<div>
    <div class="container mt-5">
        <div class="mb-4">
            <h1 class="text-white display-3 fw-bold">
                <b>
                    CoverMatch
                </b>
            </h1>
            <p class="fs-4 lh-base text-dark text-start">
                Easily find the book you are looking for! <br>
                Use our cover image-based search system to find the complete collection of books at PNJ Libraries.
            </p>
            <div>
                <a class="btn btn-lg rounded-3" style="background-color: #008797; color: white;" href="{{route('search')}}" wire:navigate>Start Searching!</a>
            </div>
        </div>
        <hr class="text-white mb-1">
        <div>
            <p class="fs-4 lh-base text-dark text-start">
                Discover over <b class="text-white fs-2">100+</b> books in <b class="text-white fs-2">10</b> categories with one click.
            </p>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        @foreach($books as $book)
                            <div class="col-3">
                                <img src="{{env('FAST_API_URL')}}/train_images/{{$book->image}}" alt="" height="175" width="125" class="rounded-3">
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-6">

                </div>
            </div>

        </div>
    </div>
</div>

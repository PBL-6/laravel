<div>
    <div class="mt-4 mb-5 container">
        <div class="row text-center">
            <div class="col-12">
                <a href="{{route('search')}}" wire:navigate class="btn btn-secondary">Back</a>
            </div>
        </div>
        <hr>
        <div class="border text-center">
            <div class="mt-2 mb-2">
                Response Time: {{round($result_book->response_time, 1)}} seconds
            </div>
            <img src="http://127.0.0.1:8000/query_images/{{$result_book->query_image}}" height="200" width="150" class="mt-2">
            <div class="row mt-2">
                @php
                    $image1 = str_replace('train_images/', '', $result_book->book_1_image);
                    $image2 = str_replace('train_images/', '', $result_book->book_2_image);
                    $image3 = str_replace('train_images/', '', $result_book->book_3_image);
                    $image4 = str_replace('train_images/', '', $result_book->book_4_image);
                @endphp
                <div class="col-3 text-center mt-3">
                    <div class="mt-2">
                        <b>Match: {{($result_book->book_1_match / 1000) * 100}}%</b>
                    </div>
                    <div class="mb-2">
                        <a href="{{route('search.detail', $image1)}}" wire:navigate class="text-decoration-none">
                            <img src="http://127.0.0.1:8000/{{$result_book->book_1_image}}" class="mt-2 mb-2 img-thumbnail" height="200" width="150">
                        </a>
                    </div>
                </div>
                @if($image2 != "")
                    <div class="col-3 text-center mt-3">
                        <div class="mt-2">
                            <b>Match: {{($result_book->book_2_match / 1000) * 100}}%</b>
                        </div>
                        <div class="mb-2">
                            <a href="{{route('search.detail', $image2)}}" wire:navigate class="text-decoration-none">
                                <img src="http://127.0.0.1:8000/{{$result_book->book_2_image}}" class="mt-2 mb-2 img-thumbnail" height="200" width="150">
                            </a>
                        </div>
                    </div>
                @endif
                @if($image3 != "")
                    <div class="col-3 text-center mt-3">
                        <div class="mt-2">
                            <b>Match: {{($result_book->book_3_match / 1000) * 100}}%</b>
                        </div>
                        <div class="mb-2">
                            <a href="{{route('search.detail', $image3)}}" wire:navigate class="text-decoration-none">
                                <img src="http://127.0.0.1:8000/{{$result_book->book_3_image}}" class="mt-2 mb-2 img-thumbnail" height="200" width="150">
                            </a>
                        </div>
                    </div>
                @endif
                @if($image4 != "")
                    <div class="col-3 text-center mt-3">
                        <div class="mt-2">
                            <b>Match: {{($result_book->book_4_match / 1000) * 100}}%</b>
                        </div>
                        <div class="mb-2">
                            <a href="{{route('search.detail', $image4)}}" wire:navigate class="text-decoration-none">
                                <img src="http://127.0.0.1:8000/{{$result_book->book_4_image}}" class="mt-2 mb-2 img-thumbnail" height="200" width="150">
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

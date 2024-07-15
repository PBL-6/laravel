<div>
    <div class="container mt-5">
        <h1 class="fw-bold text-dark">
            Search Result
        </h1>
        <p class="text-dark">
            Response Time: {{round($result_book->response_time, 1)}} seconds
        </p>
        <div class="text-center">
            <div style="height: 100%; border: 2px dashed #ccc;" class="mt-4 rounded-3">
                <div class="mt-4 mb-4 me-4 ms-4">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{env('FAST_API_URL')}}/query_images/{{$result_book->query_image}}" height="200" width="150" class="rounded-3">
{{--                            <div class="mt-2">--}}
{{--                                <b>Searched Image</b>--}}
{{--                            </div>--}}
                        </div>
                        <div class="col-8">
                            <div class="row">
                                @php
                                    $image1 = str_replace('train_images/', '', $result_book->book_1_image);
                                    $image2 = str_replace('train_images/', '', $result_book->book_2_image);
                                    $image3 = str_replace('train_images/', '', $result_book->book_3_image);
                                    $image4 = str_replace('train_images/', '', $result_book->book_4_image);
                                @endphp
                                <div class="col-3">
                                    <a href="{{route('search.detail', $image1)}}" wire:navigate class="text-decoration-none">
                                        <img src="{{env('FAST_API_URL')}}/{{$result_book->book_1_image}}" class="rounded-3" height="200" width="150">
                                    </a>
                                    <div class="mt-2">
                                        @php
                                            if($result_book->book_1_match > 1000){
                                                $matched = 100;
                                            }else{
                                                $matched = ($result_book->book_1_match / 1000) * 100;
                                            }
                                        @endphp
                                        <b>Match: {{$matched}}%</b>
                                    </div>
                                </div>
                                @if($image2 != '')
                                <div class="col-3">
                                    <a href="{{route('search.detail', $image2)}}" wire:navigate class="text-decoration-none">
                                        <img src="{{env('FAST_API_URL')}}/{{$result_book->book_2_image}}" class="rounded-3" height="200" width="150">
                                    </a>
                                    <div class="mt-2">
                                        <b>Match: {{($result_book->book_2_match / 1000) * 100}}%</b>
                                    </div>
                                </div>
                                @endif
                                @if($image3 != '')
                                    <div class="col-3">
                                        <a href="{{route('search.detail', $image3)}}" wire:navigate class="text-decoration-none">
                                            <img src="{{env('FAST_API_URL')}}/{{$result_book->book_3_image}}" class="rounded-3" height="200" width="150">
                                        </a>
                                        <div class="mt-2">
                                            <b>Match: {{($result_book->book_3_match / 1000) * 100}}%</b>
                                        </div>
                                    </div>
                                @endif
                                @if($image4 != '')
                                    <div class="col-3">
                                        <a href="{{route('search.detail', $image4)}}" wire:navigate class="text-decoration-none">
                                            <img src="{{env('FAST_API_URL')}}/{{$result_book->book_4_image}}" class="rounded-3" height="200" width="150">
                                        </a>
                                        <div class="mt-2">
                                            <b>Match: {{($result_book->book_4_match / 1000) * 100}}%</b>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{--            <a href="{{route('search')}}" wire:navigate class="btn mt-3 mb-4" style="background-color: #008797; color: white;">--}}
{{--                Back--}}
{{--            </a>--}}
        </div>
{{--        <div class="border text-center">--}}
{{--            <div class="mt-2 mb-2">--}}
{{--                Response Time: {{round($result_book->response_time, 1)}} seconds--}}
{{--            </div>--}}
{{--            <img src="{{env('FAST_API_URL')}}/query_images/{{$result_book->query_image}}" height="200" width="150" class="mt-2">--}}
{{--            <div class="row mt-2">--}}
{{--                @php--}}
{{--                    $image1 = str_replace('train_images/', '', $result_book->book_1_image);--}}
{{--                    $image2 = str_replace('train_images/', '', $result_book->book_2_image);--}}
{{--                    $image3 = str_replace('train_images/', '', $result_book->book_3_image);--}}
{{--                    $image4 = str_replace('train_images/', '', $result_book->book_4_image);--}}
{{--                @endphp--}}
{{--                <div class="col-3 text-center mt-3">--}}
{{--                    <div class="mt-2">--}}
{{--                        <b>Match: {{($result_book->book_1_match / 1000) * 100}}%</b>--}}
{{--                    </div>--}}
{{--                    <div class="mb-2">--}}
{{--                        <a href="{{route('search.detail', $image1)}}" wire:navigate class="text-decoration-none">--}}
{{--                            <img src="{{env('FAST_API_URL')}}/{{$result_book->book_1_image}}" class="mt-2 mb-2 img-thumbnail" height="200" width="150">--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @if($image2 != "")--}}
{{--                    <div class="col-3 text-center mt-3">--}}
{{--                        <div class="mt-2">--}}
{{--                            <b>Match: {{($result_book->book_2_match / 1000) * 100}}%</b>--}}
{{--                        </div>--}}
{{--                        <div class="mb-2">--}}
{{--                            <a href="{{route('search.detail', $image2)}}" wire:navigate class="text-decoration-none">--}}
{{--                                <img src="{{env('FAST_API_URL')}}/{{$result_book->book_2_image}}" class="mt-2 mb-2 img-thumbnail" height="200" width="150">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                @if($image3 != "")--}}
{{--                    <div class="col-3 text-center mt-3">--}}
{{--                        <div class="mt-2">--}}
{{--                            <b>Match: {{($result_book->book_3_match / 1000) * 100}}%</b>--}}
{{--                        </div>--}}
{{--                        <div class="mb-2">--}}
{{--                            <a href="{{route('search.detail', $image3)}}" wire:navigate class="text-decoration-none">--}}
{{--                                <img src="{{env('FAST_API_URL')}}/{{$result_book->book_3_image}}" class="mt-2 mb-2 img-thumbnail" height="200" width="150">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                @if($image4 != "")--}}
{{--                    <div class="col-3 text-center mt-3">--}}
{{--                        <div class="mt-2">--}}
{{--                            <b>Match: {{($result_book->book_4_match / 1000) * 100}}%</b>--}}
{{--                        </div>--}}
{{--                        <div class="mb-2">--}}
{{--                            <a href="{{route('search.detail', $image4)}}" wire:navigate class="text-decoration-none">--}}
{{--                                <img src="{{env('FAST_API_URL')}}/{{$result_book->book_4_image}}" class="mt-2 mb-2 img-thumbnail" height="200" width="150">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>

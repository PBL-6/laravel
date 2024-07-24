<div>
    <div class="container mt-5">
        <h1 class="fw-bold">
            Search History
        </h1>
        <div class="mt-4 text-center">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Query Image</th>
                    <th colspan="4">Result Image </th>
                    <th>Searched At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($search_history as $sh)
                    @php
                        $image1 = str_replace('train_images/', '', $sh->book_1_image);
                        $image2 = str_replace('train_images/', '', $sh->book_2_image);
                        $image3 = str_replace('train_images/', '', $sh->book_3_image);
                        $image4 = str_replace('train_images/', '', $sh->book_4_image);
                    @endphp
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td class="text-secondary">
                            <img src="{{env('FAST_API_URL')}}/query_images/{{$sh->query_image}}" alt="" height="200" width="150" class="rounded-3">
                        </td>
                        <td>
                            @if($sh->book_1_image)
                                <a href="{{route('search.detail', $image1)}}">
                                    <img src="{{env('FAST_API_URL')}}/{{$sh->book_1_image}}" alt="" height="200" width="150" class="rounded-3">
                                </a>
                                <div class="mt-2">
                                    @php
                                        if($sh->book_1_match > 1000){
                                            $matched = 100;
                                        }else{
                                            $matched = ($sh->book_1_match / 1000) * 100;
                                        }
                                    @endphp
                                    Match: {{$matched}}%
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($sh->book_2_image)
                                <a href="{{route('search.detail', $image2)}}">
                                    <img src="{{env('FAST_API_URL')}}/{{$sh->book_2_image}}" alt="" height="200" width="150" class="rounded-3">
                                </a>
                                <div class="mt-2">
                                    Match: {{($sh->book_2_match / 1000) * 100}}%
                                </div>
                            @else
                                    None
                            @endif
                        </td>
                        <td>
                            @if($sh->book_3_image)
                                <a href="{{route('search.detail', $image3)}}">
                                    <img src="{{env('FAST_API_URL')}}/{{$sh->book_3_image}}" alt="" height="200" width="150" class="rounded-3">
                                </a>
                                <div class="mt-2">
                                    Match: {{($sh->book_3_match / 1000) * 100}}%
                                </div>
                            @else
                                None
                            @endif
                        </td>
                        <td>
                            @if($sh->book_4_image)
                                <a href="{{route('search.detail', $image4)}}">
                                    <img src="{{env('FAST_API_URL')}}/{{$sh->book_4_image}}" alt="" height="200" width="150" class="rounded-3">
                                </a>
                                <div class="mt-2">
                                    Match: {{($sh->book_4_match / 1000) * 100}}%
                                </div>
                            @else
                                None
                            @endif
                        </td>
                        <td>
                            @php
                                $date = $sh->created_at;
                                $date->tz('Asia/Jakarta');
                            @endphp
                            {{$date->format('d-m-Y')}}
                            <br>
                            {{$date->format('H:i')}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if($search_history)
                <div>
                    {{$search_history->links()}}
                </div>
            @endif
        </div>
    </div>
</div>

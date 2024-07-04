<div>
    <div class="container">
        <div class="mt-3 text-center">
            <div class="row">
                <div class="col-12">
                    <a href="{{route('home')}}" wire:navigate class="btn btn-secondary">Home</a>
                </div>
            </div>
            <hr>
            <table class="table table-bordered mb-4">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Query Image</th>
                    <th colspan="4">Result Image </th>
                    <th>Response Time</th>
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
                            <img src="http://127.0.0.1:8000/query_images/{{$sh->query_image}}" alt="" height="200" width="150">
                        </td>
                        <td>
                            @if($sh->book_1_image)
                                <small><b>Match: {{($sh->book_1_match / 1000) * 100}}%</b></small>
                                <br>
                                <a href="/search/{{$image1}}">
                                    <img src="http://127.0.0.1:8000/{{$sh->book_1_image}}" alt="" height="200" width="150" class="mt-2">
                                </a>
                            @endif
                        </td>
                        <td>
                            @if($sh->book_2_image)
                                <small><b>Match: {{($sh->book_2_match / 1000) * 100}}%</b></small>
                                <br>
                                <a href="/book/{{$image2}}">
                                    <img src="http://127.0.0.1:8000/{{$sh->book_2_image}}" alt="" height="200" width="150" class="mt-2">
                                </a>
                            @else
                                None
                            @endif
                        </td>
                        <td>
                            @if($sh->book_3_image)
                                <small><b>Match: {{($sh->book_3_match / 1000) * 100}}%</b></small>
                                <br>
                                <a href="/book/{{$image3}}">
                                    <img src="http://127.0.0.1:8000/{{$sh->book_3_image}}" alt="" height="200" width="150" class="mt-2">
                                </a>
                            @else
                                None
                            @endif
                        </td>
                        <td>
                            @if($sh->book_4_image)
                                <small><b>Match: {{($sh->book_4_match / 1000) * 100}}%</b></small>
                                <br>
                                <a href="/book/{{$image4}}">
                                    <img src="http://127.0.0.1:8000/{{$sh->book_4_image}}" alt="" height="200" width="150" class="mt-2">
                                </a>
                            @else
                                None
                            @endif
                        </td>
                        <td>
                            {{round($sh->response_time, 1)}}
                            <div>
                                seconds
                            </div>
                        </td>
                        <td>
                            {{$sh->created_at->format('d-m-Y')}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

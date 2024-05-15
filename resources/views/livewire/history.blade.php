<div>
    <div class="container">
        <div class="mt-3 text-center">
            <div class="row">
                <div class="col-12">
                    <a href="/" class="btn btn-secondary">Home</a>
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
                        $image1 = str_replace('train_images/', '', $sh->book_1_image_name);
                        $image2 = str_replace('train_images/', '', $sh->book_2_image_name);
                        $image3 = str_replace('train_images/', '', $sh->book_3_image_name);
                        $image4 = str_replace('train_images/', '', $sh->book_4_image_name);
                    @endphp
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td class="text-secondary">
                            <img src="{{asset('storage/' . $sh->query_image_name)}}" alt="" height="200" width="150">
                        </td>
                        <td>
                            <small><b>Match: {{($sh->book_1_percentage / 1000) * 100}}%</b></small>
                            <a href="/book/{{$image1}}">
                                <img src="http://127.0.0.1:8000/{{$sh->book_1_image_name}}" alt="" height="200" width="150" class="mt-2">
                            </a>
                        </td>
                        <td>
                            <small><b>Match: {{($sh->book_2_percentage / 1000) * 100}}%</b></small>
                            @if($sh->book_2_image_name)
                                <a href="/book/{{$image2}}">
                                    <img src="http://127.0.0.1:8000/{{$sh->book_2_image_name}}" alt="" height="200" width="150" class="mt-2">
                                </a>
                            @else
                                <div><small>404 NOT FOUND</small></div>
                            @endif
                        </td>
                        <td>
                            <small><b>Match: {{($sh->book_3_percentage / 1000) * 100}}%</b></small>
                            @if($sh->book_3_image_name)
                                <a href="/book/{{$image3}}">
                                    <img src="http://127.0.0.1:8000/{{$sh->book_3_image_name}}" alt="" height="200" width="150" class="mt-2">
                                </a>
                            @else
                                <div><small>404 NOT FOUND</small></div>
                            @endif
                        </td>
                        <td>
                            <small><b>Match: {{($sh->book_4_percentage / 1000) * 100}}%</b></small>
                            @if($sh->book_4_image_name)
                                <a href="/book/{{$image4}}">
                                    <img src="http://127.0.0.1:8000/{{$sh->book_4_image_name}}" alt="" height="200" width="150" class="mt-2">
                                </a>
                            @else
                                <div><small>404 NOT FOUND</small></div>
                            @endif
                        </td>
                        <td>
                            {{round($sh->response_time, 1)}}
                            <div>
                                seconds
                            </div>
                        </td>
                        <td>
                            {{$sh->created_at}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

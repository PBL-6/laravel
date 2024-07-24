<div>
    <div class="container mt-5">
        <h1 class="fw-bold">
            Detail Book
        </h1>
        <div style="height: 100%; border: 2px dashed #ccc;" class="rounded-3 mt-3">
            <div class="mt-4 mb-4 me-4 ms-4">
                <div class="row">
                    <div class="col-4">
                        <div>
                            <img src="{{env('FAST_API_URL')}}/train_images/{{$book->image}}" class="rounded-3" height="350" width="250">
                        </div>
                    </div>
                    <div class="col-8">
                        <div>
                            <span class="badge text-bg-{{$book->is_available ? 'success' : 'danger'}}">{{$book->is_available ? 'Available' : 'Not Available'}}</span>
                        </div>
                        <div class="mt-2">
                            <span style="color: #008797">
                                Title
                            </span>
                            <h3 class="fw-bold text-dark">
                                {{$book->title}}
                            </h3>
                        </div>
                        <div class="mt-4">
                            <span style="color: #008797">
                                Author(s)
                            </span>
                            <h4>
                                {{$book->author}}
                            </h4>
                        </div>
                        <div class="mt-3">
                            <span style="color: #008797">
                                Category
                            </span>
                            <h4>
                                {{$book->category}}
                            </h4>
                        </div>
                        <div class="mt-3">
                            <span style="color: #008797">
                                Published Date
                            </span>
                            <h4>
                                @php
                                    $carbonDate = \Carbon\Carbon::parse($book->published_at);
                                    $date = $carbonDate->format('d-m-Y');
                                @endphp
                                {{$date}}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--        <div class="mt-3 text-center">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <a href="{{route('home')}}" wire:navigate class="btn btn-secondary">Home</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <hr>--}}
{{--            <div class="border container mt-3 mb-3 text-center">--}}
{{--                <div class="mb-2 mt-3">--}}
{{--                    <img src="{{env('FAST_API_URL')}}/train_images/{{$book->image}}" class="img-thumbnail mb-2" height="200" width="150">--}}
{{--                </div>--}}
{{--                <div class="mb-2">--}}
{{--                    <b>{{$book->title}}</b>--}}
{{--                    <hr>--}}
{{--                    <table class="table table-bordered">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th scope="col">Author</th>--}}
{{--                            <th scope="col">Available</th>--}}
{{--                            <th scope="col">Category</th>--}}
{{--                            <th scope="col">Published</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td>{{$book->author}}</td>--}}
{{--                            <td><span class="badge text-bg-{{$book->is_available ? 'success' : 'danger'}}">{{$book->is_available ? 'Available' : 'Not Available'}}</span></td>--}}
{{--                            <td><span class="badge text-bg-primary">{{$book->category}}</span></td>--}}
{{--                            <td>{{$book->published_at}}</td>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>

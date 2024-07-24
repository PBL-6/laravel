<div>
    <div class="container mt-4">
        <div class="card ms-4 me-4 rounded-3" style="border: none">
            <div class="card-body">
                <div class="float-start mb-4">
                    <h2><b>Books</b></h2>
                </div>
                <div class="float-end mb-4">
                    <a href="{{route('admin.book.create')}}" wire:navigate class="btn rounded-3" style="background-color: #008797; color: white; border: none">
                        <i class="bi bi-plus-lg me-1" style="color: white;"></i>
                        <span>Add Book</span>
                    </a>
                </div>

                    <table class="table table-bordered text-center mt-4">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Available</th>
                            <th>Published</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $index => $book)
                            <tr>
                                <td>{{$books->firstItem() + $index }}</td>
                                <td>{{$book->title}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->category}}</td>
                                <td>{{$book->is_available ? 'Yes' : 'No'}}</td>
                                @php
                                    $carbonDate = \Carbon\Carbon::parse($book->published_at);
                                    $date = $carbonDate->format('d-m-Y');
                                @endphp
                                <td>{{$date}}</td>
                                <td>
                                    <a href="{{route('admin.book.edit', $book->id)}}" class="btn rounded-3" style="background-color: #008797; color: white; border: none" wire:navigate>
                                        <i class="bi bi-pencil-square text-white"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @if($books)
                    <div>
                        {{$books->links()}}
                    </div>
                @endif
            </div>
        </div>
{{--        <div class="table-data">--}}
{{--            <div class="book">--}}
{{--                <div class="head">--}}
{{--                    <h3>Books</h3>--}}
{{--                    <div class="add">--}}
{{--                        <a href="#" class="btn rounded-3" style="background-color: #008797; color: white;">--}}
{{--                            <i class="bi bi-plus-lg me-1" style="color: white;"></i>--}}
{{--                            <span>Add Book</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <table>--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Title</th>--}}
{{--                        <th>Author</th>--}}
{{--                        <th>Category</th>--}}
{{--                        <th>Status</th>--}}
{{--                        <th>Published</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                        @foreach($books as $book)--}}
{{--                            <tr>--}}
{{--                                <td><small>{{$book->title}}</small></td>--}}
{{--                                <td><small>{{$book->author}}</small></td>--}}
{{--                                <td><small>{{$book->category}}</small></td>--}}
{{--                                <td><small>{{$book->is_available ? 'Yes' : 'No'}}</small></td>--}}
{{--                                <td><small>{{$book->published_at}}</small></td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}

        {{--        <a href="{{route('admin.book.create')}}" wire:navigate>Add book</a>--}}
{{--        <a href="{{route('admin.home')}}" wire:navigate>Dashboard</a>--}}
{{--        <hr>--}}
{{--        <div class="row">--}}
{{--            <div class="table-responsive">--}}
{{--                <table class="table table-bordered text-center">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col"><small>Book</small></th>--}}
{{--                        <th scope="col"><small>Title</small></th>--}}
{{--                        <th scope="col"><small>Author</small></th>--}}
{{--                        <th scope="col"><small>Category</small></th>--}}
{{--                        <th scope="col"><small>Available</small></th>--}}
{{--                        <th scope="col"><small>Published</small></th>--}}
{{--                        <th scope="col"><small>Action</small></th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($books as $book)--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <img src="{{env('FAST_API_URL')}}/train_images/{{$book->image}}" alt="" style="width: 50px; height: 50px">--}}
{{--                            </td>--}}
{{--                            <td><small>{{$book->title}}</small></td>--}}
{{--                            <td><small>{{$book->author}}</small></td>--}}
{{--                            <td><small>{{$book->category}}</small></td>--}}
{{--                            <td><small>{{$book->is_available ? 'Yes' : 'No'}}</small></td>--}}
{{--                            <td><small>{{$book->published_at}}</small></td>--}}
{{--                            <td>--}}
{{--                                <a href="{{route('admin.book.edit', $book->id)}}" class="btn btn-primary btn-sm" wire:navigate>Edit</a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--            @if($books)--}}
{{--                <div>--}}
{{--                    {{$books->links()}}--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
    </div>
</div>

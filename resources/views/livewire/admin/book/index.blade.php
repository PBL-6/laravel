<div>
    <div class="container mt-4">
        <a href="{{route('admin.book.create')}}" wire:navigate>Add book</a>
        <a href="{{route('admin.home')}}" wire:navigate>Dashboard</a>
        <hr>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th scope="col"><small>Book</small></th>
                        <th scope="col"><small>Title</small></th>
                        <th scope="col"><small>Author</small></th>
                        <th scope="col"><small>Category</small></th>
                        <th scope="col"><small>Available</small></th>
                        <th scope="col"><small>Published</small></th>
                        <th scope="col"><small>Action</small></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>
                                <img src="{{env('FAST_API_URL')}}/train_images/{{$book->image}}" alt="" style="width: 50px; height: 50px">
                            </td>
                            <td><small>{{$book->title}}</small></td>
                            <td><small>{{$book->author}}</small></td>
                            <td><small>{{$book->category}}</small></td>
                            <td><small>{{$book->is_available ? 'Yes' : 'No'}}</small></td>
                            <td><small>{{$book->published_at}}</small></td>
                            <td>
                                <a href="{{route('admin.book.edit', $book->id)}}" class="btn btn-primary btn-sm" wire:navigate>Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($books)
                <div>
                    {{$books->links()}}
                </div>
            @endif
        </div>

    </div>
</div>

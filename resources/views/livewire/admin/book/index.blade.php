<div>
    <div class="container mt-4">
        <a href="{{route('admin.book.create')}}" wire:navigate>Add book</a>
        <a href="{{route('admin.home')}}" wire:navigate>Dashboard</a>
        <hr>
        <div class="row">
            @forelse($books as $book)
                <div class="col-3 text-center mb-4">
{{--                    <div>--}}
{{--                        <img src="http://127.0.0.1:8000/train_images/{{$book->image}}" alt="" style="width: 150px; height: 200px">--}}
{{--                        {{$book->title}}--}}
{{--                    </div>--}}
                    <div class="card">
                        <div class="card-body" style="height: 350px">
                            <a href="{{route('admin.book.edit', $book->id)}}" wire:navigate>
                                <img src="http://127.0.0.1:8000/train_images/{{$book->image}}" alt="" style="width: 150px; height: 200px">
                                <div class="mt-3">
                                    <b>
                                        {{$book->title}}
                                    </b>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center">
                    No Data
                </div>
            @endforelse
            @if($books)
                <div>
                    {{$books->links()}}
                </div>
            @endif
        </div>

    </div>
</div>

<div>
    <div class="container">
        <div class="mt-3 text-center">
            <div class="row">
                <div class="col-12">
                    <a href="{{route('home')}}" wire:navigate class="btn btn-secondary">Home</a>
                </div>
            </div>
            <hr>
            <div class="border container mt-3 mb-3 text-center">
                <div class="mb-2 mt-3">
                    <img src="http://127.0.0.1:8000/train_images/{{$book->image}}" class="img-thumbnail mb-2" height="200" width="150">
                </div>
                <div class="mb-2">
                    <b>{{$book->title}}</b>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Author</th>
                            <th scope="col">Available</th>
                            <th scope="col">Category</th>
                            <th scope="col">Published</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$book->author}}</td>
                            <td><span class="badge text-bg-{{$book->is_available ? 'success' : 'danger'}}">{{$book->is_available ? 'Available' : 'Not Available'}}</span></td>
                            <td><span class="badge text-bg-primary">{{$book->category}}</span></td>
                            <td>{{$book->published_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="container">
        <div class="mt-3 text-center">
            <div class="row">
                <div class="col-12">
                    <a href="/" class="btn btn-secondary">Home</a>
                </div>
            </div>
            <hr>
            <div class="border container mt-3 mb-3 text-center">
                <div class="mb-2 mt-3">
                    <img src="http://127.0.0.1:8000/train_images/{{$result_book->image}}" class="img-thumbnail mb-2" height="200" width="150">
                </div>
                <div class="mb-2">
                    <b>{{$result_book->title}}</b>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Author</th>
                            <th scope="col">Available</th>
                            <th scope="col">Location</th>
                            <th scope="col">Uploaded</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$result_book->author}}</td>
                            <td><span class="badge text-bg-{{$result_book->is_available ? 'success' : 'danger'}}">{{$result_book->is_available ? 'Available' : 'Not Available'}}</span></td>
                            <td>
                                @if($result_book->location != null && $result_book->is_available)
                                    Rak: ({{$result_book->location[0]}}), Baris: ({{$result_book->location[1]}}), Kolom: ({{$result_book->location[2]}})
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{$result_book->created_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

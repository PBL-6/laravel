<div>
    <div class="container">
        <div class="mt-4 text-center">
            <div class="row">
                <div class="col-12">
                    <a href="/" class="btn btn-secondary" wire:navigate>Home</a>
                    <button class="btn btn-primary" wire:click="openSelectBookModal">Select Book Cover</button>
                    <button class="btn btn-success">Take Book Cover Picture</button>
                </div>
{{--                <div class="col-6">--}}
{{--                    <button class="btn btn-success" wire:click="openTakeModal">Take Book Cover Picture</button>--}}
{{--                </div>--}}
            </div>
        </div>
        <hr>
        @if($is_select_book_modal_open)
             <div class="border mt-3 rounded-3 mb-3">
                <div class="container">
    {{--                    <div class="row mt-2">--}}
    {{--                        <div class="col-12">--}}
    {{--                            <div class="text-center">--}}
    {{--                                test--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
                    <div class="row mt-2 mb-2">
                        @forelse($uploadBooks as $uploadBook)
                            <div class="col-2 text-center">
                                <img src="{{asset('storage/' . $uploadBook->image)}}" class="mt-2 mb-2 img-thumbnail" height="200" width="150">
                                <button class="btn btn-sm btn-primary w-100 mb-2" wire:click="selectSearchBook('{{$uploadBook->id}}')" id="selectBookButton" wire:loading.attr="disabled">
                                    Select
                                    <span class="spinner-border spinner-border-sm ms-1  " aria-hidden="true" wire:loading wire:target="selectSearchBook('{{$uploadBook->id}}')"></span>
                                </button>
                            </div>
                        @empty
                            <div class="text-center mt-4 mb-4">
                                Data uploaded cover books is empty!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

        <div class="border container mt-3 mb-3" style="display: none" id="takeShow">
            <div class="mt-3 mb-3">
                <div>
                    <video id="video" autoplay class="img-thumbnail" width="300" height="400"></video>
                    <canvas id="canvas" width="300" height="400" style="display: none" class="text-center"></canvas>
                </div>
                <div class="mt-3 text-center">
                    <button id="start-camera" class="btn btn-success rounded-3">Start Camera</button>
                    <button id="click-photo" class="btn btn-success rounded-3">Take Picture</button>
                </div>
            </div>
            <form wire:submit="searchBook" >
                <input type="file" id="fileInput" accept="image/*" style="display: none" wire:model="image">
            </form>
        </div>

        @if($is_results_book_modal_open)
            <div class="container mt-3 border mb-3" id="showResult">
                <div>
                    Response Time: {{round($response_time, 1)}} seconds
                </div>
                <div class="row mt-2">
                    @foreach ($result_books as $item)
                        <div class="col-3 text-center">
                            <div class="mt-2">
                                <b>Match: {{($item[0] / 1000) * 100}}%</b>
                            </div>
                            <div class="mb-2">
                                @php
                                    $image = str_replace('train_images/', '', $item[1]);
                                @endphp
                                <a href="/book/{{$image}}" class="text-decoration-none" target="_blank">
                                    <img src="http://127.0.0.1:8000/{{$item[1]}}" class="mt-2 mb-2 img-thumbnail" height="200" width="150">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($result_book)
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
                <div class="mt-3 mb-3">
                    <button class="btn btn-success btn-sm" @if($result_book->location) @else disabled @endif>Show Book Location</button>
                    <button wire:click.prevent="openResultsBookModal" class="btn btn-secondary btn-sm">Back</button>
                </div>
            </div>
        @endif

    </div>
</div>

@script
    <script>
        let camera_button = document.querySelector("#start-camera");
        let video = document.querySelector("#video");
        let click_button = document.querySelector("#click-photo");
        let canvas = document.querySelector("#canvas");
        let fileInput = document.querySelector("#fileInput");
        let takeButton = document.querySelector('#takeButton');
        // let takeShow = document.querySelector('#takeShow');
        // let selectButton = document.querySelector('#selectButton');
        // let selectShow = document.querySelector('#selectShow');
        // let uploadButton = document.querySelector('#uploadButton');
        // let uploadShow = document.querySelector('#uploadShow');
        // let selectBookButton = document.querySelector('#selectBookButton');
        let localstream;

        // takeButton.addEventListener('click', function () {
        //     selectShow.style.display = 'none';
        //     uploadShow.style.display = 'none';
        //     takeShow.style.display = 'block';
        // })
        //
        // selectButton.addEventListener('click', function (e) {
        //     e.preventDefault();
        //     if(localstream){
        //         localstream.getTracks()[0].stop();
        //     }
        //     takeShow.style.display = 'none';
        //     uploadShow.style.display = 'none';
        //     selectShow.style.display = 'block';
        // })
        //
        // uploadButton.addEventListener('click', function (e){
        //     e.preventDefault();
        //     if(localstream){
        //         localstream.getTracks()[0].stop();
        //     }
        //     takeShow.style.display = 'none';
        //     selectShow.style.display = 'none';
        //     uploadShow.style.display = 'block';
        // });

        // selectBookButton.addEventListener('click', function () {
        //     selectShow.style.display = 'none';
        // })

        camera_button.addEventListener('click', async function() {
            if(video.style.display === 'none'){
                video.style.display = 'block';
                canvas.style.display = 'none';
            }
            let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
            video.srcObject = stream;
            localstream = stream;
        });

        click_button.addEventListener('click', function() {
            video.style.display = 'none';
            canvas.style.display = 'block';

            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            let image_data_url = canvas.toDataURL('image/jpeg');

            localstream.getTracks()[0].stop();

            let list = new DataTransfer();
            let file = new File([image_data_url], "filename.jpg");
            list.items.add(file);

            let myFileList = list.files;

            fileInput.files = myFileList;
        });
    </script>
@endscript

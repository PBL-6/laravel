<div>
    <div class="container">
        <div class="mt-4 text-center">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary" id="selectButton">Select Book Cover</button>
                    <button class="btn btn-success" id="takeButton">Take Book Cover Picture</button>
                    <div>
                        <small>or</small>
                    </div>
                    <div>
                        <a href="#" class="text-decoration-none" id="uploadButton"><small>Upload book cover</small></a>
                    </div>
                </div>
{{--                <div class="col-6">--}}
{{--                    <button class="btn btn-success" wire:click="openTakeModal">Take Book Cover Picture</button>--}}
{{--                </div>--}}
            </div>
        </div>

        <form wire:submit="saveUploadBook" class="border mt-3 mb-3 rounded-3" id="uploadShow" style="display: none">
            <div class="container">
                <div class="text-center">
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="mt-3 img-thumbnail" height="200" width="150">
                    @endif
                    <input type="file" wire:model="image" class="mt-3 form-control @error('image') is-invalid @enderror rounded-3" id="{{$file_iteration}}" accept="image/*">
                    @error('image')
                        <div class="text-danger mb-2"><small>{{ $message }}</small></div>
                    @enderror
                    <button type="submit" class="btn btn-primary w-100 mt-2 rounded-3 mb-2">Upload image</button>
                </div>
            </div>
        </form>

         <div class="border mt-3 rounded-3 mb-3" id="selectShow" style="display: none">
            <div class="container">
{{--                    <div class="row mt-2">--}}
{{--                        <div class="col-12">--}}
{{--                            <div class="text-center">--}}
{{--                                test--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                <div class="row">
                    @foreach($uploadBooks as $uploadBook)
                        <div class="col-2 text-center">
                            <img src="{{asset('storage/' . $uploadBook->image)}}" class="mt-2 mb-2 img-thumbnail" height="200" width="150">
                            <button class="btn btn-sm btn-primary w-100 mb-2" wire:click="selectSearchBook('{{$uploadBook->id}}')" id="selectBookButton">Select</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

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

    @if($result_books)
        <div class="container mt-4 border mb-4" id="showResult">
            <div class="row">
                @foreach ($result_books as $item)
                    <div class="col-3">
                        @foreach ($item as $key => $value)
                                    @if(is_numeric($value))
                                        <div class="mt-2">
                                            {{$value}}
                                        </div>
                                    @else
                                        <div class="mb-2">
                                            <img src="http://127.0.0.1:8000/{{$value}}" class="mt-2 mb-2 img-thumbnail" height="200" width="150">
                                        </div>
                                    @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>

@script
    <script>
        let camera_button = document.querySelector("#start-camera");
        let video = document.querySelector("#video");
        let click_button = document.querySelector("#click-photo");
        let canvas = document.querySelector("#canvas");
        let fileInput = document.querySelector("#fileInput");
        let takeButton = document.querySelector('#takeButton');
        let takeShow = document.querySelector('#takeShow');
        let selectButton = document.querySelector('#selectButton');
        let selectShow = document.querySelector('#selectShow');
        let uploadButton = document.querySelector('#uploadButton');
        let uploadShow = document.querySelector('#uploadShow');
        let selectBookButton = document.querySelector('#selectBookButton');
        let localstream;

        takeButton.addEventListener('click', function () {
            selectShow.style.display = 'none';
            uploadShow.style.display = 'none';
            takeShow.style.display = 'block';
        })

        selectButton.addEventListener('click', function (e) {
            e.preventDefault();
            if(localstream){
                localstream.getTracks()[0].stop();
            }
            takeShow.style.display = 'none';
            uploadShow.style.display = 'none';
            selectShow.style.display = 'block';
        })

        uploadButton.addEventListener('click', function (e){
            e.preventDefault();
            if(localstream){
                localstream.getTracks()[0].stop();
            }
            takeShow.style.display = 'none';
            selectShow.style.display = 'none';
            uploadShow.style.display = 'block';
        });

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

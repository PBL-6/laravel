@extends('components.layouts.app')

@section('main')
    <div class="border container mt-5">
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
        <input type="file" id="fileInput" accept="image/*" style="display: none">
    </div>

    <script>
        let camera_button = document.querySelector("#start-camera");
        let video = document.querySelector("#video");
        let click_button = document.querySelector("#click-photo");
        let canvas = document.querySelector("#canvas");
        let fileInput = document.querySelector("#fileInput");
        let localstream;

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
@endsection

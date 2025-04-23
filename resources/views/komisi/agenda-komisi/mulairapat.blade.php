@extends('komisi.agenda-komisi.layouts.layout')

@section('content')
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Stay organized with our user-friendly Calendar featuring events, reminders, and a customizable interface. Built with HTML, CSS, and JavaScript. Start scheduling today!"
    />
    <meta
      name="keywords"
      content="calendar, events, reminders, javascript, html, css, open source coding"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>
<link href="{{ asset('stylemulairapat.css') }}" rel="stylesheet">
<!-- resources/views/komisi/agenda-komisi/mulairapat.blade.php -->
@extends('komisi.agenda-komisi.layouts.layout')

@section('content')
<div class="container">
    <h2>Start Rapat</h2>
    <p><strong>Date:</strong> {{ $rapat->tanggal }}</p>
    <p><strong>Time:</strong> {{ $rapat->waktu_mulai }} - {{ $rapat->waktu_selesai }}</p>
    <p><strong>Title:</strong> {{ $rapat->nama }}</p>
    <p><strong>Agenda:</strong> {{ $rapat->agenda }}</p>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Take Attendance</h5>
                </div>
                <div class="card-body">
                    <form action="/komisi-ii/rapat/{{ $rapat->id }}/attendance" method="POST" enctype="multipart/form-data">                        @csrf
                        <div class="form-group">
                            <label for="image">Capture or Upload Image</label>
                            <input type="file" class="form-control" name="image" id="image" accept="image/*" capture="camera">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Recognize Faces</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Live Recognition</h5>
                </div>
                <div class="card-body">
                    <div id="video-container">
                        <video id="video" width="100%" autoplay></video>
                        <canvas id="canvas" style="display:none;"></canvas>
                    </div>
                    
                    <button id="start-camera" class="btn btn-info mt-3">
                        <i class="fas fa-camera"></i> Start Camera
                    </button>
                    
                    <button id="capture-btn" class="btn btn-primary mt-3" style="display:none;">
                        <i class="fas fa-check-circle"></i> Capture & Recognize
                    </button>
                    
                    <form id="attendance-form" action="/komisi-ii/rapat/{{ $rapat->id }}/attendance" method="POST" style="display:none;">
                        @csrf
                        <input type="hidden" name="image_data" id="image-data">
                    </form>
                </div>
                
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const video = document.getElementById('video');
                    const canvas = document.getElementById('canvas');
                    const startBtn = document.getElementById('start-camera');
                    const captureBtn = document.getElementById('capture-btn');
                    const form = document.getElementById('attendance-form');
                    const imageData = document.getElementById('image-data');
                    let stream = null;
                
                    // Start camera when button clicked
                    startBtn.addEventListener('click', async function() {
                        try {
                            stream = await navigator.mediaDevices.getUserMedia({ 
                                video: { facingMode: 'user' } // Front camera
                            });
                            video.srcObject = stream;
                            startBtn.style.display = 'none';
                            captureBtn.style.display = 'block';
                        } catch (err) {
                            console.error("Camera error: ", err);
                            alert('Could not access camera. Please ensure you have granted permissions.');
                        }
                    });
                
                    // Capture image
                    captureBtn.addEventListener('click', function() {
                        const context = canvas.getContext('2d');
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);
                        
                        // Convert to base64 for form submission
                        const image = canvas.toDataURL('image/jpeg');
                        imageData.value = image;
                        
                        // Stop camera stream
                        if (stream) {
                            stream.getTracks().forEach(track => track.stop());
                        }
                        
                        // Submit form
                        form.submit();
                    });
                });
                </script>
@endsection

@endsection

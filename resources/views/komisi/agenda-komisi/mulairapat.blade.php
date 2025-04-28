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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
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

    <div class="attendance-section">
        <h3>Attendance Tracking</h3>
        <div id="webgl-error" class="error-message" style="display: none;">
            <p>WebGL is not supported on your device. Please try using a different browser or device.</p>
        </div>
        <div class="video-container">
            <video id="video" width="720" height="560" autoplay muted></video>
        </div>
        <div class="controls">
            <button id="startButton" class="btn-absen">Start Camera</button>
            <button id="captureButton" class="btn-absen" style="display: none;">Capture Face</button>
        </div>
        <div id="attendanceList" class="attendance-list">
            <h4>Attendance List</h4>
            <ul id="attendanceRecords"></ul>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let video;
    let startButton;
    let captureButton;
    let attendanceRecords = [];
    let isCameraStarted = false;

    // Check WebGL support
    function checkWebGLSupport() {
        try {
            const canvas = document.createElement('canvas');
            const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
            if (!gl) {
                document.getElementById('webgl-error').style.display = 'block';
                document.getElementById('startButton').disabled = true;
                return false;
            }
            return true;
        } catch (e) {
            document.getElementById('webgl-error').style.display = 'block';
            document.getElementById('startButton').disabled = true;
            return false;
        }
    }

    // Load face-api models
    if (checkWebGLSupport()) {
        Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
            faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
            faceapi.nets.faceRecognitionNet.loadFromUri('/models'),
            faceapi.nets.faceExpressionNet.loadFromUri('/models')
        ]).then(startVideo).catch(error => {
            console.error('Error loading face-api models:', error);
            alert('Error loading face recognition models. Please refresh the page and try again.');
        });
    }

    function startVideo() {
        video = document.getElementById('video');
        startButton = document.getElementById('startButton');
        captureButton = document.getElementById('captureButton');

        startButton.addEventListener('click', async () => {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                video.srcObject = stream;
                isCameraStarted = true;
                startButton.style.display = 'none';
                captureButton.style.display = 'block';
            } catch (err) {
                console.error('Error accessing camera:', err);
                alert('Error accessing camera. Please make sure you have granted camera permissions.');
            }
        });

        captureButton.addEventListener('click', async () => {
            if (!isCameraStarted) return;

            try {
                const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
                    .withFaceLandmarks()
                    .withFaceExpressions();

                if (detections.length > 0) {
                    // Face detected, record attendance
                    const attendanceData = {
                        rapat_id: {{ $rapat->id }},
                        nama: '{{ $rapat->nama }}',
                        email: '{{ $rapat->email }}',
                        waktu_absen: new Date().toISOString(),
                        komisi_type: '{{ $rapat->komisi_type }}'
                    };

                    // Send to server
                    try {
                        const response = await fetch('/api/attendance', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(attendanceData)
                        });

                        if (response.ok) {
                            const data = await response.json();
                            addAttendanceRecord(data);
                        } else {
                            alert('Error recording attendance');
                        }
                    } catch (err) {
                        console.error('Error sending attendance data:', err);
                        alert('Error recording attendance');
                    }
                } else {
                    alert('No face detected. Please position yourself in front of the camera.');
                }
            } catch (err) {
                console.error('Error detecting face:', err);
                alert('Error detecting face. Please try again.');
            }
        });
    }

    function addAttendanceRecord(record) {
        const list = document.getElementById('attendanceRecords');
        const item = document.createElement('li');
        item.textContent = `${record.nama} - ${new Date(record.waktu_absen).toLocaleString()}`;
        list.appendChild(item);
    }
});
</script>

<style>
.attendance-section {
    margin-top: 2rem;
    padding: 1rem;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.video-container {
    margin: 1rem 0;
    text-align: center;
}

.controls {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin: 1rem 0;
}

.attendance-list {
    margin-top: 2rem;
}

.attendance-list ul {
    list-style: none;
    padding: 0;
}

.attendance-list li {
    padding: 0.5rem;
    border-bottom: 1px solid #eee;
}

.error-message {
    background-color: #ffebee;
    color: #c62828;
    padding: 1rem;
    border-radius: 4px;
    margin: 1rem 0;
    text-align: center;
}
</style>
@endsection

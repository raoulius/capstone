@extends('komisi.agenda-komisi.layouts.layout')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
@endpush
@push('styles')
<link href="{{ asset('stylemulairapat.css') }}" rel="stylesheet">
@endpush
<!-- resources/views/komisi/agenda-komisi/mulairapat.blade.php -->

@section('content')
<h2 class="section-title">START RAPAT</h2>
<div class="container">
    

<div class="rapat-info">
    <div class="info-item">
        <span class="label">Date:</span>
        <span class="value">{{ $rapat->tanggal }}</span>
    </div>
    <div class="info-item">
        <span class="label">Time:</span>
        <span class="value">{{ $rapat->waktu_mulai }} - {{ $rapat->waktu_selesai }}</span>
    </div>
    <div class="info-item">
        <span class="label">Title:</span>
        <span class="value">{{ $rapat->nama }}</span>
    </div>
    <div class="info-item">
        <span class="label">Agenda:</span>
        <span class="value">{{ $rapat->agenda }}</span>
    </div>
</div>


    <div class="attendance-section">
        <h3>Attendance Tracking</h3>
        <div id="webgl-error" class="error-message" style="display: none;">
            <p>WebGL is not supported on your device. Please try using a different browser or device.</p>
        </div>
        <div class="video-container">
            <video id="video" width="720" height="560" autoplay muted></video>
        </div>
        <div class="controls">
            <button id="startButton" class="btn1">Start Camera</button>
            <button id="captureButton" class="btn1" style="display: none;">Capture Face</button>
        </div>
        <div id="attendanceList" class="attendance-list">
            <h4>Attendance List</h4>
            <button id="refresh" class="btn1" onclick="refreshAttendance()">Refresh</button>
            <ul id="attendanceRecords"></ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    
    let attendanceRecords = [];
    async function refreshAttendance () {
        try {
            const response = await fetch('{{ route("attendance.get-detail", $rapat->id)}}', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                credentials: "same-origin"
            });
            data = await response.json()
            data.forEach(item => {
                addAttendanceRecord(item)
            })
        } catch (error) {
            
        }
    }

    refreshAttendance()
    function addAttendanceRecord(record) {
        const list = document.getElementById('attendanceRecords');
        const item = document.createElement('li');
        item.textContent = `${record.nama} - ${new Date(record.waktu_absen).toLocaleString()}`;
        list.appendChild(item);
    }

    document.addEventListener('DOMContentLoaded', function() {
    let video;
    let startButton;
    let captureButton;
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
                    .withFaceDescriptors()
                    .withFaceExpressions();

                if (detections.length > 0) {
                    const descriptors = {!! json_encode(auth()->user()->userFace->pluck('descriptor')->map(function ($item) {
                        return json_decode($item); // ubah string JSON ke array
                    })->toArray()) !!}

                    const attendanceData = {
                        user_id: {{auth()->user()->id}},
                        rapat_id: {{ $rapat->id }},
                        nama: '{{ $rapat->nama }}',
                        email: '{{ $rapat->email }}',
                        waktu_absen: new Date().toISOString(),
                        komisi_type: '{{ $komisi_type }}'
                    };

                    let results = 1;
                    descriptors.forEach(descriptor => {
                        const tempResult = faceapi.euclideanDistance(detections[0].descriptor, descriptor)
                        console.log(tempResult)
                        results = tempResult < results ? tempResult : results
                    });

                    if (results > 0.5) {
                        alert('Face does not match')
                        return;
                    }

                    try {
                        const response = await fetch('{{ route("attendance.record")}}', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
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

});
</script>
@endpush
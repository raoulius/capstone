@extends('komisi.agenda-komisi.layouts.layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('styleface.css') }}">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .student-form {
        max-width: 500px;
        margin: 30px auto;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }

    .student-form label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }

    .student-form .form-group {
        margin-bottom: 15px;
    }

    .student-form input,
    .student-form select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    .student-form input:focus,
    .student-form select:focus {
        border-color: #007bff;
        outline: none;
    }

    #studentDetails {
        margin-top: 20px;
    }
</style>

@endpush

@section('content')
<h3 class="h3">FACE RECOGNITION</h3>
<div class="container">
    <div class="attendance-section">
        
        <div id="webgl-error" class="error-message" style="display: none;">
            <p>WebGL is not supported on your device. Please try using a different browser or device.</p>
        </div>
        <div class="video-container">
            <video id="video" width="720" height="560" autoplay muted style="display: none;"></video>
        </div>
        <div class="student-form">
            <label for="studentSelect">Mahasiswa</label>
            <select id="studentSelect" style="width: 100%;" class="form-control"></select>
            <div id="studentDetails" class="mt-3" style="">
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" id="nim" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control">
                </div>
            </div>
        </div>
        <div class="controls">
            <button id="startButton" class="btn">Start Camera</button>
            <button id="captureButton" class="btn" style="display: none;">Capture Face</button>
            <label for="imageUpload" class="btn mt-2">
                Upload Face from File
            </label>
            <input type="file" id="imageUpload" accept="image/*" style="display: none;">
        </div>
        <div id="faceList" class="attendance-list">
            <h4 class="h4">FACE LIST</h4>
            <ul id="attendanceRecords" class="grid-container"></ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
<script>
    $(document).ready(function () {
        $('#studentSelect').select2({
            placeholder: 'Cari Mahasiswa...',
            ajax: {
                url: '{{ route("members.index", auth()->user()->role->id) }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data.map(student => ({
                            id: student.id,
                            text: `${student.nim} - ${student.name}`,
                            student
                        }))
                    };
                },
                cache: true
            }
        });
    
        $('#studentSelect').on('select2:select', function (e) {
            const selected = e.params.data.student;
            $('#studentDetails').show();
            $('#nim').val(selected.nim);
            $('#name').val(selected.name);
            $('#email').val(selected.email);
        });
    });
</script>
<script>
    let faceData = {!! auth()->user()->userFace->makeHidden('descriptor') !!}

function renderFaces() {
  const container = document.getElementById('attendanceRecords');
  container.innerHTML = '';
  faceData.forEach(face => {
    const item = document.createElement('div');
    item.classList.add('grid-item');
    item.innerHTML = `
      <img src="{{ url('/storage' )}}/${face.path}" alt="Face ${face.id}">
      <button class="delete-btn" onclick="deleteFace(${face.id})">Delete</button>
    `;
    container.appendChild(item);
  });
}

async function deleteFace(id) {
  const index = faceData.findIndex(f => f.id === id);
  if (index > -1) {
    try {
        const response = await fetch(`{{ url("face") }}/${id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            credentials: 'same-origin'
        });

        if (response.ok) {
            faceData.splice(index, 1);
            renderFaces();
            alert('Face deleted!')
        } else {
            alert('Error deleting attendance');
        }
    } catch (err) {
        console.error('Error sending attendance data:', err);
        alert('Error deleting attendance');
    }
  }
}

renderFaces();
</script>
<script>
    function getSnapshotFromVideo(videoElement) {
    const canvas = document.createElement('canvas');
    canvas.width = videoElement.videoWidth;
    canvas.height = videoElement.videoHeight;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
    return canvas.toDataURL('image/jpeg'); // base64 image
}

function imageToBase64(image) {
    return new Promise((resolve) => {
        const canvas = document.createElement('canvas');
        canvas.width = image.width;
        canvas.height = image.height;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(image, 0, 0);
        resolve(canvas.toDataURL('image/jpeg'));
    });
}

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
                video.style.display = 'block'; // Menampilkan video setelah kamera aktif
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
                    const snapshot = getSnapshotFromVideo(video);
                    const attendanceData = {
                        name: $('#name').val(),
                        nim: $('#nim').val(),
                        email: $('#email').val(),
                        descriptor: Object.values(detections[0].descriptor),
                        image: snapshot // base64 encoded image string
                    };

                    try {
                        const response = await fetch('{{ route("face.store") }}', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            credentials: 'same-origin',
                            body: JSON.stringify(attendanceData)
                        });

                        if (response.ok) {
                            const data = await response.json();
                            faceData.push(data.data)
                            renderFaces();
                            alert('Face recorded!')
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

    document.getElementById('imageUpload').addEventListener('change', async function(event) {
        const file = event.target.files[0];
        if (!file) return;

        const img = await faceapi.bufferToImage(file);
        const canvas = faceapi.createCanvasFromMedia(img);
        // document.body.appendChild(canvas); // opsional, bisa dipakai untuk preview

        const detections = await faceapi.detectAllFaces(img, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptors();

        if (detections.length > 0) {
            const base64 = await imageToBase64(img);
            const attendanceData = {
                descriptor: Object.values(detections[0].descriptor),
                image: base64,
                name: $('#name').val(),
                nim: $('#nim').val(),
                email: $('#email').val(),
            };

            try {
                const response = await fetch('{{ route("face.store") }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(attendanceData)
                });

                if (response.ok) {
                    const data = await response.json();
                    faceData.push(data.data)
                    renderFaces();
                    alert('Face recorded!')
                } else {
                    alert('Error recording attendance from file.');
                }
            } catch (err) {
                console.error('Error uploading file for attendance:', err);
                alert('Error sending image.');
            }
        } else {
            alert('No face detected in uploaded image.');
        }
    });
});
</script>
@endpush
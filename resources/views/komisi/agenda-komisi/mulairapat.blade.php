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

<div class="container">
    <h2>Start Rapat</h2>
    <div class="meeting-details mb-4">
        <p><strong>Date:</strong> {{ $rapat->tanggal }}</p>
        <p><strong>Time:</strong> {{ $rapat->waktu_mulai }} - {{ $rapat->waktu_selesai }}</p>
        <p><strong>Title:</strong> {{ $rapat->nama }}</p>
        <p><strong>Agenda:</strong> {{ $rapat->agenda }}</p>
    </div>

    <div class="attendance-section">
        <button type="button" id="startRecognition" class="btn btn-primary">
            Start Facial Recognition Attendance
        </button>

        <div id="recognitionResults" class="mt-3" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <h4>Recognized Attendees:</h4>
                </div>
                <div class="card-body">
                    <ul id="attendeesList" class="list-group list-group-flush"></ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('startRecognition').addEventListener('click', function() {
    const rapatId = '{{ $rapat->id }}'; // Using the actual rapat ID from the current meeting
    
    // Show loading state
    this.disabled = true;
    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

    fetch(`/facial-recognition/start/${rapatId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const resultDiv = document.getElementById('recognitionResults');
                const attendeesList = document.getElementById('attendeesList');
                
                // Clear previous results
                attendeesList.innerHTML = '';
                
                // Add each recognized person to the list
                data.recognized_people.forEach(person => {
                    const li = document.createElement('li');
                    li.className = 'list-group-item';
                    li.innerHTML = `<i class="fas fa-user"></i> ${person}`;
                    attendeesList.appendChild(li);
                });
                
                resultDiv.style.display = 'block';
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing facial recognition');
        })
        .finally(() => {
            // Reset button state
            this.disabled = false;
            this.innerHTML = 'Start Facial Recognition Attendance';
        });
});
</script>

<style>
.meeting-details {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.attendance-section {
    margin-top: 20px;
}

#startRecognition {
    margin-bottom: 20px;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.list-group-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.list-group-item i {
    color: #007bff;
}
</style>

@endsection

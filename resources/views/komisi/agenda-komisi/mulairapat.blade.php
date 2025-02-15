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

<h2 class="header">MEETING SCHEDULE</h2>

<!-- Tombol Absen -->
<div class="button-container">
    <button class="btn-absen" onclick="handleAbsen()">Absen Sekarang</button>
</div>

<!-- Tabel Meeting Schedule -->
<div class="table-container">
    <table class="schedule-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Meeting Title</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Monthly Review</td>
                <td>2025-01-25</td>
                <td>10:00 AM</td>
                <td>Conference Room A</td>
                <td><button class="btn-details">Details</button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Project Kickoff</td>
                <td>2025-01-28</td>
                <td>02:00 PM</td>
                <td>Conference Room B</td>
                <td><button class="btn-details">Details</button></td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    function handleAbsen() {
        alert('Absen berhasil dilakukan!');
    }

    public function mulaiRapat(Request $request)
{
    $eventTitle = $request->query('event'); // Mengambil parameter 'event'
    return view('komisi-i.mulai-rapat', compact('eventTitle'));
}

</script>
@endsection

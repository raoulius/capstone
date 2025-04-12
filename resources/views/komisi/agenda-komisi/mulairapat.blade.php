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
    <p><strong>Date:</strong> {{ $rapat->tanggal }}</p>
    <p><strong>Time:</strong> {{ $rapat->waktu_mulai }} - {{ $rapat->waktu_selesai }}</p>
    <p><strong>Title:</strong> {{ $rapat->nama }}</p>
    <p><strong>Agenda:</strong> {{ $rapat->agenda }}</p>
    <!-- Add more details or functionality as needed -->
</div>


@endsection

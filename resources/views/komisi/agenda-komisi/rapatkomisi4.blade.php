@extends('komisi.agenda-komisi.layouts.layout')
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

@section('content')
<div class="container">
    <h2>Komisi 4 Rapat List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Title</th>
                <th>Agenda</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rapats as $rapat)
            <tr>
                <td>{{ $rapat->tanggal }}</td>
                <td>{{ $rapat->waktu_mulai }} - {{ $rapat->waktu_selesai }}</td>
                <td>{{ $rapat->nama }}</td>
                <td>{{ $rapat->agenda }}</td>
                <td>
                    <a href="{{ route('komisi-iv.rapat.mulai', $rapat->id) }}" class="btn btn-primary">Start Meeting</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

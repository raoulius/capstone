@extends('komisi.agenda-komisi.layouts.layout')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{ asset("stylerapat.css") }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

@endpush

@section('content')
<h2 class="header">{{ $komisiName }} RAPAT LIST</h2>
<div class="container">
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
                    <a href="{{ route("{$komisiRoute}.rapat.mulai", $rapat->id) }}" class="btn1 btn-primary">Start Meeting</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

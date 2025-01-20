@extends('cms.layouts.layout')
<<<<<<< HEAD
<link href="{{ URL::asset("cms/events/styletest.css") }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

@section('content')
<div class="">
    <h1 class="mb-4 text-center">DAFTAR SEMUA RAPAT</h1>
    
    <table class="table table-hover">
        <thead class="table-header">
=======

@section('content')
<div class="container">
    <h1>Semua Rapat</h1>
    
    <table class="table">
        <thead>
>>>>>>> 3cf42efab0bccce4622f097d80eea028511b0c9d
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Jenis Rapat</th>
                <th>Komisi/Badan</th>
                <th>Agenda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rapat as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}</td>
                <td>{{ $item->jenis_rapat }}</td>
                <td>{{ $item->komisi_type }}</td>
                <td>{{ $item->agenda }}</td>
            </tr>
            @endforeach
<<<<<<< HEAD
        </tbody>
    </table>
</div>
@endsection
=======
        </tbody> 
    </table>
</div>
@endsection
>>>>>>> 3cf42efab0bccce4622f097d80eea028511b0c9d

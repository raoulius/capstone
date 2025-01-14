@extends('cms.layouts.layout')

@section('content')
<div class="container">
    <h1>Semua Rapat</h1>
    
    <table class="table">
        <thead>
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
        </tbody>
    </table>
</div>
@endsection
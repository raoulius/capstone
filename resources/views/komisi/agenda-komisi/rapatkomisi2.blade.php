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
    <h2>Komisi 2 Rapat List</h2>
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
            @forelse($rapats as $rapat)
                <tr>
                    <td>{{ $rapat->tanggal }}</td>
                    <td>{{ $rapat->waktu_mulai }} - {{ $rapat->waktu_selesai }}</td>
                    <td>{{ $rapat->nama }}</td>
                    <td>{{ $rapat->agenda }}</td>
                    <td>
                        <a href="{{ route('komisi-ii.rapat.mulai', $rapat->id) }}" class="btn btn-primary">Start Meeting</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No meetings found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Debug section -->
    <div class="mt-4">
        <h4>Debug Information:</h4>
        <p>Number of meetings: {{ $rapats->count() }}</p>
        <pre>{{ print_r($rapats->toArray(), true) }}</pre>
    </div>
</div>

<style>
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    padding: 0.375rem 0.75rem;
    border-radius: 0.25rem;
    text-decoration: none;
    display: inline-block;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.text-center {
    text-align: center;
}

.mt-4 {
    margin-top: 1.5rem;
}
</style>
@endsection

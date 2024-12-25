@extends("cms.layouts.layout")

@section("content")
<link href="{{ URL::asset('cms/buatrapat/createrapat.css') }}" rel="stylesheet">

<body>
    <h1>Create Rapat records</h1>
    <h3>BKSAP</h3>
    <h2>Silakan isi formulir di bawah ini sebelum memulai rapat</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div id="resetAlert" class="alert alert-warning" style="display: none;">
        Form berhasil direset!
    </div>
    
    <form action="{{ route('admin.buatrapat.bksapstore') }}" method="POST">
        @csrf <!-- Laravel's CSRF protection -->
        <div class="meeting-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
        </div>

        <div class="meeting-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="meeting-group">
            <label for="tanggal">Tanggal Rapat:</label>
            <input type="date" id="tanggal" name="tanggal" required>
        </div>

        <div class="meeting-group">
            <label for="waktu_mulai">Waktu Mulai Rapat:</label>
            <input type="time" id="waktu_mulai" name="waktu_mulai" required>
        </div>

        <div class="meeting-group">
            <label for="waktu_selesai">Waktu Selesai Rapat:</label>
            <input type="time" id="waktu_selesai" name="waktu_selesai" required>
        </div>

        <div class="meeting-group">
            <label for="jenis_rapat">Jenis Rapat:</label>
            <input type="text" id="jenis_rapat" name="jenis_rapat" required>
        </div>

        <div class="meeting-group">
            <label for="agenda">Agenda Rapat:</label>
            <textarea id="agenda" name="agenda" rows="4" required></textarea>
        </div>

        <div class="button-grid">
            <button type="submit">Kirim</button>
            <button type="reset" onclick="showResetMessage()" id="resetBtn">Reset</button>
        </div>
    </form>
</body>
<script src="{{ asset('cms/buatrapat/js-buatrapat.js') }}"></script>
@endsection

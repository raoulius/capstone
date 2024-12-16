@extends("cms.layouts.layout")

@section("content")
  <link href="{{ URL::asset("cms/buatrapat/createrapat.css") }}" rel="stylesheet">

  <body>
        <h1>Create Rapat records</h1>
        <h2>Silakan isi formulir di bawah ini sebelum memulai rapat</h2>
        
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
            <label for="waktu">Waktu Mulai Rapat</label>
            <input type="time" id="waktu" name="waktu" required>
        </div>

        <div class="meeting-group">
            <label for="waktu">Waktu Selesai Rapat:</label>
            <input type="time" id="waktu" name="waktu" required>
        </div>

        <div class="meeting-group">
            <label for="email">Jenis Rapat:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="meeting-group">
            <label for="agenda">Agenda Rapat:</label>
            <textarea id="agenda" name="agenda" rows="4" required></textarea>
        </div>

        <div class="button-grid">
            <button type="submit">Kirim</button>
            <button type="reset">Reset</button>
        </div>
    </div>
</body>
@endsection




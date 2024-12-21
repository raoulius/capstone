@extends("cms.layouts.layout")

@section("content")
  <link href="{{ URL::asset("cms/buatrapat/styleindex.css") }}" rel="stylesheet">

  <body>
            <h1>Jadwal Rapat</h1>
            <div class="meeting-group">
                <h2>Komisi</h2>
                <div class="button-grid" id="komisi-list">
                    <button class="btn"><a href="{{ route("admin.buatrapat.create") }}">Komisi 1</a></button>
                    <button class="btn"><a href="{{ route("admin.buatrapat.create") }}">Komisi 2</a></button>
                    <button class="btn"><a href="{{ route("admin.buatrapat.create") }}">Komisi 3</a></button>
                    <button class="btn"><a href="{{ route("admin.buatrapat.create") }}">Komisi 4</a></button>                    
            </div>
            <div class="meeting-group">
                <h2>Badan Kepengurusan</h2>
                <div class="button-grid" id="badan-list">
                    <button class="btn"><a href="{{ route("admin.buatrapat.create") }}">Badan Legislasi</a></button>
                    <button class="btn"><a href="{{ route("admin.buatrapat.create") }}">Badan Anggaran</a></button>
                    <button class="btn"><a href="{{ route("admin.buatrapat.create") }}">Badan Kehormatan</a></button>
                    <button class="btn"><a href="{{ route("admin.buatrapat.create") }}">BKSAP</a></button>
                </div>
            </div>
        </div>
        <script> function startMeeting(meetingName) {
            alert("Memulai pertemuan untuk: " + meetingName); 
            }</script>
  </body>
@endsection

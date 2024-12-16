@extends("cms.layouts.layout")

@section("content")
  <link href="{{ URL::asset("cms/buatrapat/styleindex.css") }}" rel="stylesheet">

  <body>
            <h1>Jadwal Rapat</h1>
            <div class="meeting-group">
                <h2>Komisi</h2>
                <div class="button-grid" id="komisi-list">
                    <button class="btn"><a href="{{ route("admin.buatrapat.create") }}">Komisi 1</a></button>
                    <button onclick="startMeeting('Komisi 2')">Komisi 2</button>
                    <button onclick="startMeeting('Komisi 3')">Komisi 3</button>
                    <button onclick="startMeeting('Komisi 4')">Komisi 4</button>
                </div>
            </div>
            <div class="meeting-group">
                <h2>Badan Kepengurusan</h2>
                <div class="button-grid" id="badan-list">
                    <button onclick="startMeeting('badan Legislatif')">Badan Legislatif</button>
                    <button onclick="startMeeting('Badan Kehormatan 2')">Badan Kehormatan</button>
                    <button onclick="startMeeting('BKSAP')">BKSAP</button>
                    <button onclick="startMeeting('Badan Anggaran')">Badan Anggaran</button>
                </div>
            </div>
        </div>
        <script> function startMeeting(meetingName) {
            alert("Memulai pertemuan untuk: " + meetingName); 
            }</script>
  </body>
@endsection

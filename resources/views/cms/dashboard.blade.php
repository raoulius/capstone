@extends("cms.layouts.layout")

@section("content")
  <link href="{{ URL::asset("cms/styledashboard.css") }}" rel="stylesheet">

  <body>
    <h1>Dashboard CMS Senat FH Undip</h1><br>
    <div class="grid">
      <a href="{{ url('/admin/aktivitas') }}"><button class="btn item">Aktivitas Senat</button></a>
      <a href="{{ url('/admin/jdih') }}"><button class="btn item">JDIH</button></a>
      <a href="{{ url('/admin/rooms') }}"><button class="btn item">Ruangan</button></a>
      <a href="{{ url('/admin/room-schedules') }}"><button class="btn item">Jadwal Ruangan</button></a>
      <a href="{{ url('/admin/bankaspirasi') }}"><button class="btn item">Bank Aspirasi</button></a>
      <a href="{{ url('/admin/events') }}"><button class="btn item">Events</button></a>
      <a href="{{ url('/admin/persetujuan-proposal') }}"><button class="btn item">Persetujuan Proposal</button></a>
      <a href="{{ url('/admin/faq') }}"><button class="btn item">FAQ</button></a>
      <a href="{{ url('/admin/buatrapat') }}"><button class="btn item">Buat Rapat</button></a>
      <a href="{{ url('/admin/evalsenator') }}"><button class="btn item">Eval Senator</button></a>
      <a href="{{ url('/admin/jadwalrapat') }}"><button class="btn item">Jadwal Rapat</button></a>
      



    </div>

  </body>
@endsection

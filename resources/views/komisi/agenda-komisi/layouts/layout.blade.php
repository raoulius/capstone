<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css" rel="stylesheet">
  <link href="{{ asset("stylelayout.css") }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" rel="stylesheet"
    integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
    rel="stylesheet"
    integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('stylecommon.css')}}">

  @stack('styles')

  <link type="image/x-icon" href="{{ URL::asset("img/coba23.ico") }}" rel="icon">
  <link type="image/x-icon" href="{{ URL::asset("img/coba23.ico") }}" rel="shortcut icon">
  <title>SENAT FH UNDIP</title>
</head>

<body>
  <nav>
    <div class="nav-logo">
      <a href="{{ url("/" . auth()->user()->role->role_slug . "/agendakerja") }}">
        <img src="/img/coba1.png" alt="Logo">
      </a>
    </div>

    <ul class="nav-links">
      <li class="link" id="link1"><a href="{{ url("/" . auth()->user()->role->role_slug . "/agendakerja") }}">Agenda
          Kerja</a></li>
      <li class="link" id="link4"><a href="{{ url("/" . auth()->user()->role->role_slug . "/transparansisurat")
          }}">Transparansi Surat</a></li>
      <li class="link" id="link4"><a href="{{ url("/" . auth()->user()->role->role_slug . "/rapat") }}">Rapat</a></li>
      <li class="link" id="link4"><a href="{{ route("face.index") }}">Face
        @if (count(auth()->user()->userFace) == 0)
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff0a0a" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert-icon lucide-circle-alert"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
        @endif
      </a></li>

    </ul>

    <a href="{{ route("logout") }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <button class="btn" type="button">Log Out</button>
    </a>
    <form id="logout-form" style="display: none;" action="{{ route("logout") }}" method="POST">
      @csrf
    </form>
  </nav>

  @yield("content")

  <footer class="container-f">
    <span class="blur"></span>
    <span class="blur"></span>
    <div class="column">
      <div class="logo">
        <img src="/img/coba1.png">
      </div>
      <p>SENAT MAHASISWA FAKULTAS HUKUM UNDIP</p>
      <p class="address">
        Jl. Prof. Soedarto, Tembalang, Kec. Tembalang, Kota Semarang, Jawa Tengah 50275
      </p>
      <div class="socials">
        <a href="#"><i class="ri-youtube-line"></i></a>
        <a href="#"><i class="ri-instagram-line"></i></a>
        <a href="https://lin.ee/VJdJQ9z"><i class="ri-line-line"></i></a>
      </div>
    </div>

    <div class="column">
      <h4>Komisi</h4>
      <a href="{{ url("/tentang-komisi-i") }}">Komisi I</a>
      <a href="{{ url("/tentang-komisi-ii") }}">Komisi II</a>
      <a href="{{ url("/tentang-komisi-iii") }}">Komisi III</a>
      <a href="{{ url("/tentang-komisi-iv") }}">Komisi IV</a>
    </div>
    <div class="column">
      <h4>Badan</h4>
      <a href="{{ url("/tentang-badan-anggaran") }}">Badan Anggaran</a>
      <a href="{{ url("/tentang-badan-kehormatan") }}">Badan Kehormatan</a>
      <a href="{{ url("/tentang-badan-legislasi") }}">Badan Legislasi</a>
      <a href="{{ url("/tentang-bksap") }}">BKSAP</a>
    </div>
    <div class="column">
      <h4>JDIH</h4>
      <a href="#">Peraturan Mahasiswa</a>
      <a href="#">Standard Operating Procedure</a>
      <a href="#">Peraturan Senat Mahasiswa</a>
      <a href="#">Keputusan</a>
      <a href="#">Rancangan Peraturan</a>
    </div>
  </footer>

  <div class="copyright">
    Copyright © 2023 SENAT FH UNDIP. All Rights Reserved.
  </div>
</body>

@stack('scripts')
@push('scripts')
@if(!request()->routeIs('rapat.mulai'))
<script src="{{ asset('script7.js') }}"></script>
@endif
@endpush

</html>
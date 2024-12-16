@extends('komisi.agenda-komisi.layouts.layout')

@section('content')
<link href="{{ asset("stylerapat.css") }}" rel="stylesheet">
<section class="container">
    <h2 class="header">MEETING SCHEDULE</h2>
    <div class="container">
      <div class="row">
        <div class="col-12 mt-3">
          <div id='calendar'></div>
        </div>
      </div>
    </div>

    <div class="modal" id="modal-action" tabindex="-1">

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous"
      referrerpolicy="no-referrer"></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.7/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous"
      referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
      const modal = $('#modal-action')
      const csrfToken = $('meta[name=csrf_token]').attr('content')

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap5',
        events: "{{ route("legislasi.list") }}",
        editable: false,
        eventDidMount: function(info) {
            // Memeriksa kategori dari event
            var category = info.event.extendedProps.category;

            // Mengatur warna event berdasarkan kategori
            var backgroundColor;
            var borderColor;

            switch (category) {
                case 'success':
                    backgroundColor = '#2B6172';
                    borderColor = '#2B6172';
                    break;
                case 'danger':
                    backgroundColor = '#FDF4E6';
                    borderColor = '#FDF4E6';
                    break;
                case 'warning':
                    backgroundColor = '#FEFEFE';
                    borderColor = '#FEFEFE';
                    break;
                case 'info':
                    backgroundColor = '#AEAAAA';
                    borderColor = '#AEAAAA';
                    break;
                case 'primary':
                    backgroundColor = '#A13D3E';
                    borderColor = '#A13D3E';
                    break;
                case 'secondary':
                    backgroundColor = '#94e51a';
                    borderColor = '#94e51a';
                    break;
                case 'dark':
                    backgroundColor = '#8e7e71';
                    borderColor = '#8e7e71';
                    break;
                case 'light':
                    backgroundColor = '#96a659';
                    borderColor = '#96a659';
                    break;
                case 'link':
                    backgroundColor = '#84629d';
                    borderColor = '#84629d';
                    break;
                default:
                    backgroundColor = '#CCCCCC';
                    borderColor = '#CCCCCC';
            }

            // Atur warna background dan border
            info.el.style.backgroundColor = backgroundColor;
            info.el.style.borderColor = borderColor;
            const title = info.event.title;
            info.el.setAttribute('title', title);
        },
        eventClick: function(arg) {
            var title = arg.event.title; 
            const eventDetailHTML = `
                <div>
                    <h2>${title}</h2>
                </div>
            `;
            modal.html(eventDetailHTML).modal('show');
        }
    });
    calendar.render();
});
    </script>

  </section>
    

    @endsection

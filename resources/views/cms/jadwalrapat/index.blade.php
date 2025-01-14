@extends("cms.layouts.layout")
@section("content")

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" rel="stylesheet" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ URL::asset("cms/events/styleindex.css") }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal-action" tabindex="-1"></div>
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
        const csrfToken = $('meta[name=csrf-token]').attr('content')

// ... existing code ...

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap5',
        events: `{{ url("master-rapat.list") }}`,  // Changed this line
        editable: true,
        eventContent: function(arg) {
            return {
                html: `
                    <div class="fc-content">
                        <div class="fc-title">${arg.event.title}</div>
                        <div class="fc-description small">${arg.event.extendedProps.komisi_type}</div>
                    </div>
                `
            };
        },
        eventClick: function ({ event }) {
            $.ajax({
                url: `{{ route("admin/master-rapat") }}/${event.id}/edit`,
                success: function (res) {
                    modal.html(res).modal('show')

                    $('#form-action').on('submit', function (e) {
                        e.preventDefault()
                        const form = this
                        const formData = new FormData(form)
                        $.ajax({
                            url: form.action,
                            method: form.method,
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function (res) {
                                modal.modal('hide')
                                calendar.refetchEvents()
                            }
                        })
                    })
                }
            })
        },
        eventDrop: function (info) {
            const event = info.event
            $.ajax({
                url: `{{ url("admin/master-rapat") }}/${event.id}`,
                method: 'put',
                data: {
                    id: event.id,
                    tanggal: event.start.toISOString().substring(0, 10),
                    waktu_mulai: event.start.toISOString().substring(11, 16),
                    waktu_selesai: event.end.toISOString().substring(11, 16),
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    accept: 'application/json'
                },
                success: function (res) {
                    iziToast.success({
                        title: 'Success',
                        message: res.message,
                        position: 'topRight'
                    });
                },
                error: function (res) {
                    const message = res.responseJSON.message
                    info.revert()
                    iziToast.error({
                        title: 'Error',
                        message: message ?? 'Something wrong',
                        position: 'topRight'
                    });
                }
            })
        }
    });
    calendar.render();
});
    </script>
@endsection

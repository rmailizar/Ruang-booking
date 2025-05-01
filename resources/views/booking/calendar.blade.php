@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <h2 class="mb-4 fw-bold">Jadwal Booking Ruangan</h2>
    <div id="calendar"></div>
    <!-- Modal -->
    <div class="modal fade" id="bookingDetailModal" tabindex="-1" aria-labelledby="bookingDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title fw-bold" id="bookingDetailModalLabel">Detail Booking</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <p>
                <i class="menu-icon mdi mdi-clipboard-account text-primary"></i>
                <strong>Nama Peminjam:</strong> <span id="detail-user"></span>
            </p>
            <p>
                <i class="menu-icon mdi mdi-email text-primary"></i>
                <strong>Email:</strong> <span id="detail-email"></span>
            </p>
            <p>
                <i class="menu-icon mdi mdi-city text-primary"></i>
                <strong>Ruangan:</strong> <span id="detail-room"></span>
            </p>
            <p>
                <i class="menu-icon mdi mdi-google-maps text-primary"></i>
                <strong>Lokasi:</strong> <span id="detail-location"></span>
            </p>
            <p>
                <i class="menu-icon mdi mdi-clock-in  text-primary"></i>
                <strong>Mulai:</strong> <span id="detail-start"></span>
            </p>
            <p>
                <i class="menu-icon mdi mdi-clock-out text-primary"></i>
                <strong>Selesai:</strong> <span id="detail-end"></span>
            </p>
            <p>
                <i class="menu-icon mdi mdi-clipboard-text text-primary"></i>
                <strong>Acara/Kegiatan:</strong> <span id="detail-reason"></span>
            </p>
            </div>
        </div>
        </div>
    </div>
  
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
    
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: "{{ route('calendar.data') }}",
            eventClick: function(info) {
                const eventId = info.event.id;
    
                fetch(`/calendar/detail/${eventId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('detail-user').textContent = data.user;
                        document.getElementById('detail-email').textContent = data.email;
                        document.getElementById('detail-room').textContent = data.room;
                        document.getElementById('detail-location').textContent = data.location;
                        document.getElementById('detail-start').textContent = data.start;
                        document.getElementById('detail-end').textContent = data.end;
                        document.getElementById('detail-reason').textContent = data.reason;
    
                        const modal = new bootstrap.Modal(document.getElementById('bookingDetailModal'));
                        modal.show();
                    })
                    .catch(error => {
                        console.error("Gagal fetch detail booking", error);
                    });
            }
        });
    
        calendar.render();
    });
    </script>
    
@endsection

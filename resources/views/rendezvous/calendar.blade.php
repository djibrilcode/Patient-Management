@extends('layouts.app')

@section('title', 'Calendrier des Rendez-vous')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">
        <i class="bi bi-calendar3-event text-primary"></i> Calendrier des Rendez-vous
    </h2>

    <div id="calendar"></div>
</div>

<!-- Pass PHP events data to JS -->
<script id="events-data" type="application/json">
    {!! json_encode($events) !!}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const events = JSON.parse(document.getElementById('events-data').textContent);
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        events: events,
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },
        eventClick: function(info) {
            window.location.href = `/rendezvous/${info.event.id}`;
        }
    });

    calendar.render();
});
</script>

<style>
  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }
</style>
@endsection

@extends('tenant.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl mb-6 text-center">Calendario de Horarios Reservados</h2>

        <div id="calendar" class="bg-white rounded shadow p-4"></div>

        <style>
            .fc-event.evento-finalizado {
                opacity: 0.5 !important;
            }

            .fc-event.evento-cancelado {
                opacity: 0.6 !important;
                text-decoration: line-through;
                font-style: italic;
            }
        </style>

    </div>
@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                nowIndicator: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Hoy',     //cambie el texto para que no saliera en ingles
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día'
                },
                events: '{{ route('calendar.events') }}',
                eventClick: function (info) {
                    const evento = info.event;
                    const props = evento.extendedProps;

                    const confirmar = confirm(
                        '🐾 Mascota: ' + props.pet_name + '\n' +
                        '👤 Dueño: ' + props.client_name + '\n' +
                        '📞 Teléfono: ' + props.client_phone + '\n\n' +
                        '¿Deseas cancelar esta cita?'
                    );

                    if (confirmar && props.appointment_id) {
                        fetch(`/appointments/${props.appointment_id}/cancel`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        })
                            .then(response => {
                                if (response.ok) {
                                    alert('✅ Cita cancelada exitosamente');
                                    info.event.remove(); // Opcional: quitarlo del calendario sin recargar
                                } else {
                                    alert('❌ No se pudo cancelar la cita');
                                }
                            })
                            .catch(() => alert('❌ Error al cancelar la cita'));
                    }
                }

            });

            calendar.render();
        });
    </script>
@endsection
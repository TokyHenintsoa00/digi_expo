@extends('parent.ParentAdmin')
@section('calendrierSuiviAdminSection')

<script src='{{ asset('assets/js/index.global.js') }}'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');


        let video_conference = @json($video_conference);
        console.log(video_conference);

        let events7 = video_conference.map(function(item){
            return{
                title:'Video conference',
                start:item.date_heure_salle_conference,
                allDay: true,
                editable: false,
            };

        });

        console.log(events7);


        let video_contenue = @json($contenue_video);
        let events6 = video_contenue.map(function(item){
            return{
                title:'Contenue video',
                start:item.date_creation_video,
                allDay: true,
                editable: false,
            };
        });

        let  photo = @json($contenue_photo);
        let events5 = photo.map(function(item){
            return{
                title:'Contenue photo',
                start : item.date_creation,
                allDay: true,
                editable: false,
            };
        });


        let mouvement = @json($getMouvementPersonnel);
        let events4 = mouvement.map(function(item){
            return{
                title:item.id_etat ==8 ?'employer licensier' : 'employer demissionner',
                start:item.date_mouvement,
                allDay: true,
                editable: false,
                backgroundColor: '#ff0000',
                borderColor: '#ff0000',

            };
        });


        let emp = @json($allEmp);
        let events3 = emp.map(function(item) {
            return{
                title:item.nom_emp ||'Employer',
                allDay: true,
                editable: false,
                start:item.date_membre,
                backgroundColor: item.color,
                borderColor: item.color,
                textColor: item.white
            };
        });


        let stand = @json($globalStand);
        let events2 = stand.map(function(item){
            return{
                title:item.nom_stand,
                start:item.date_de_creation_stand,
                allDay: true,
                editable: false,
                backgroundColor:'#291f16',
                borderColor: '#291f16',
            };
        });

        let getAllEvents = @json($events);
        console.log(getAllEvents);

        let events1 = getAllEvents.map(function (item) {
            return{
                id: item.id,
                title: item.title || 'TEST',
                start: item.start,
                end: item.end,
                backgroundColor: item.color,
                borderColor: item.color,
                textColor: item.white
            };
        });

        var allEvents = [
            ...events1, ...events2, ...events3, ...events4, ...events5, ...events6, ...events7
        ];
        // console.log(allEvents);


        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialDate: new Date().toISOString().slice(0, 10),
            navLinks: true,
            selectable: true,
            selectMirror: true,
            editable: true,
            dayMaxEvents: true,
            events: allEvents,

            eventMouseEnter: function(info) {
                var tooltip = document.createElement('div');
                tooltip.id = 'eventTooltip';
                tooltip.style.position = 'absolute';
                tooltip.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
                tooltip.style.color = 'white';
                tooltip.style.padding = '5px 10px';
                tooltip.style.borderRadius = '5px';
                tooltip.style.fontSize = '12px';
                tooltip.style.zIndex = '1000';
                tooltip.innerText = info.event.title;

                document.body.appendChild(tooltip);

                tooltip.style.left = `${info.jsEvent.pageX + 10}px`;
                tooltip.style.top = `${info.jsEvent.pageY + 10}px`;

                info.el.addEventListener('mouseleave', function() {
                    if (tooltip) {
                        tooltip.remove();
                    }
                });
            },

            select: function(arg) {
                var now = new Date();
                var startDateTime = new Date(arg.start);
                startDateTime.setHours(new Date().getHours(), new Date().getMinutes(), 0, 0);

                var startDateTimeFormatted = startDateTime.toISOString().slice(0, 16);

                var modalContent = `
                    <div>
                        <label for="eventTitle">Titre de l'événement :</label>
                        <input type="text" class="form-control" id="eventTitle" placeholder="Titre de l'événement" required>

                    </div>
                    <div>
                        <label for="endDate">Date de fin :</label>
                        <input type="datetime-local" class="form-control" id="endDate" value="${arg.startStr}" min="${arg.startStr}" required>
                    </div>
                    <div>
                        <label for="importance">Choisissez l'importance :</label><br>
                        <input type="radio" id="importance_bleu" name="importance" value="bleu">
                        <label for="importance_bleu">Moins important</label><br>
                        <input type="radio" id="importance_jaune" name="importance" value="jaune">
                        <label for="importance_jaune">Important</label><br>
                        <input type="radio" id="importance_rouge" name="importance" value="rouge">
                        <label for="importance_rouge">Très important</label>
                    </div>
                    <div>
                        <button id="saveEvent" class="btn btn-primary">Enregistrer l'événement</button>

                        <form action="{{route('viewCalendrierSuivi')}}">
                            <button id="cancelEvent" class="btn btn-secondary">Annuler</button>
                        </form>
                    </div>
                `;

                var modal = document.createElement('div');
                modal.innerHTML = modalContent;
                modal.id = 'eventModal';
                modal.style.position = 'fixed';
                modal.style.top = '50%';
                modal.style.left = '50%';
                modal.style.transform = 'translate(-50%, -50%)';
                modal.style.padding = '20px';
                modal.style.background = 'white';
                modal.style.border = '1px solid #ccc';
                modal.style.zIndex = '9999';

                document.body.appendChild(modal);

                document.getElementById('cancelEvent').addEventListener('click', function() {
                    document.body.removeChild(modal);
                    calendar.unselect();
                });

                document.getElementById('saveEvent').addEventListener('click', function() {
                    var title = document.getElementById('eventTitle').value;
                    var endDate = document.getElementById('endDate').value;
                    var importance = document.querySelector('input[name="importance"]:checked')?.value;




                    if (title && importance && endDate) {
                        var eventColor;
                        switch (importance) {
                            case 'bleu':
                                eventColor = '#3788d8';
                                break;
                            case 'jaune':
                                eventColor = '#d5ad2f';
                                break;
                            case 'rouge':
                                eventColor = '#ff0000';
                                break;
                            default:
                                eventColor = 'gray';
                                break;
                        }

                        var newEvent = {
                            title: title,
                            start: arg.start,
                            end: endDate,
                            allDay: true,
                            backgroundColor: eventColor,
                            borderColor: eventColor,
                            textColor: 'white'
                        };

                        calendar.addEvent(newEvent);

                        fetch('{{ route('storeEvent') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                title: title,
                                start: new Date(arg.start).toISOString(),
                                end: new Date(endDate).toISOString(),
                                importance: importance,
                                color: eventColor
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Événement enregistré :', data);
                            window.location.href = "{{ route('viewCalendrierSuiviAdmin') }}";

                        })
                        .catch(error => {
                            console.error('Erreur lors de l\'enregistrement de l\'événement:', error);
                        });

                        document.body.removeChild(modal);
                        calendar.unselect();
                    } else {
                        alert('Veuillez remplir tous les champs requis.');
                    }
                });
            },

            //supprimer evenement
            eventClick: function(arg) {
                if (confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')) {
                    arg.event.remove();

                    fetch('{{ route('deleteEvent') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ id: arg.event.id })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Événement supprimé :', data);
                    })
                    .catch(error => {
                        console.error('Erreur lors de la suppression de l\'événement:', error);
                    });
                }
            },



            //changement evenement
            eventDrop: function(info) {
            // Récupérer la durée initiale
            var oldStart = info.oldEvent.start;
            var oldEnd = info.oldEvent.end || info.oldEvent.start; // Si pas de date de fin, la même que la date de début
            var duration = oldEnd - oldStart; // Durée en millisecondes

            // Calculer la nouvelle date de fin
            var newStart = info.event.start;
            var newEnd = new Date(newStart.getTime() + duration);

            // Envoyer les données mises à jour au serveur
            fetch('{{ route('updateEvent') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: info.event.id,
                    start: newStart.toISOString(),
                    end: newEnd.toISOString()
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Événement mis à jour :', data);
            })
            .catch(error => {
                console.error('Erreur lors de la mise à jour de l\'événement:', error);
                // Revenir à l'état précédent en cas d'erreur
                info.revert();
            });
        }




        });

        calendar.render();
    });
</script>

<style>
    #calendar {
        max-width: 1100px;
        margin: 0 auto;
    }

    #calendar a {
        color: black !important;
        text-decoration: none;
    }

    #calendar a:hover {
        color: black !important;
    }
</style>

<div id='calendar'></div>

@endsection
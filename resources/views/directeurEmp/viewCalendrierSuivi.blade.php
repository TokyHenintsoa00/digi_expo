@extends('parent.parentDirecteurEmp')
@section('viewCalendrierSuiviSection')

<script src='{{ asset('assets/js/index.global.js') }}'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        let videConference = @json($video_conference);

        let events7 = videConference.map(function(item) {
            return{
                title: 'Video conference : '+item.titre_video,
                start:item.date_heure_salle_conference,
                allDay: true,
                editable: false,
                clickable: false


            };
        });

        //get mouvement
        let mouvementEvent = @json($mouvement_personnel);
        console.log(mouvementEvent);

        let events6 = mouvementEvent.map(function(item) {
            return{
                title: item.id_etat == 8 ? 'employer licensier' : 'employer demissionner',
                start:item.date_mouvement,
                allDay: true,
                editable: false,
                backgroundColor:'#ff0033',
                borderColor: '#ff0033',
                clickable: false

            };
        });

        //get brochure
        let brochureEvent = @json($contenue_brochure);
        console.log(brochureEvent);

        let events5 = brochureEvent.map(function (item) {
            return{
                title:"Brochure :"+item.nom_brochure_stand,
                start:item.date_ajout_brochure,
                allDay: true,
                //pour eveiter le deplacement
                editable: false,
                backgroundColor:'#291f16',
                borderColor: '#291f16',
                clickable: false

            };
        });

        //get contenue video
        let videoEvent = @json($contenue_video);
        console.log(videoEvent);

        let events4 = videoEvent.map(function (item) {
            return{
                title:"Galerie video: "+item.titre_video,
                start:item.date_creation_video,
                allDay: true,
                editable: false,
                backgroundColor:'#291f16',
                borderColor: '#291f16',
                clickable: false

            };
        });



        //get contenue photo
        let photoEvent = @json($contenue_photo);
        console.log(photoEvent);

        let events3 = photoEvent.map(function(item) {
            return{

                title:"Galerie photo : "+item.nom_type_stand +" "+item.nom_info_type_stand,
                start:item.date_creation,
                allDay: true,
                editable: false,
                backgroundColor:'#291f16',
                borderColor: '#291f16',
                clickable: false
            };
        });

        //get stand
        let standEvent = @json($stand_directeur);
        console.log(standEvent);

        let events2 = standEvent.map(function(item){
            return{
                title:"Exposition: " +item.nom_stand,
                start:item.date_de_creation_stand,
                allDay: true,
                editable: false,
                backgroundColor:'#67bc44',
                borderColor: '#67bc44',
                clickable: false

            };
        });

        var eventData = @json($eventData);

        var events1 = eventData.map(function(item) {
            return {
                id: item.id,
                title: item.title,
                start: item.start,
                end: item.end,
                backgroundColor: item.color,
                borderColor: item.color,
                textColor: item.white

            };
        });

        var membreStandData = @json($membre_stand);


        var events = membreStandData.map(function(item) {
            return {
                title: 'Recrutement: ' + item.prenom_emp,
                start: item.date_membre,
                allDay: true,
                editable: false,

            };
        });

        var allEvents = [...events, ...events1, ...events2, ...events3, ...events4,
            ...events5, ...events6, ...events7
        ];
        console.log(allEvents);


          // Ajoutez une propriété personnalisée pour indiquer si un événement est cliquable
            allEvents = allEvents.map(event => ({
                ...event,
                isClickable: event.clickable !== false // Par défaut, cliquable sauf si clickable est false
            }));


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

            // titre au moment de la passage de la souris
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

            //new event dans le calendrier
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
                            window.location.href = "{{ route('viewCalendrierSuivi') }}";

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

                if (!arg.event.extendedProps.isClickable) {
                   return null;
                }

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



            //changement evenement =>deplacement de evenement
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
        max-width: 1100px; /* Largeur maximale pour éviter de trop remplir l'écran */
        margin: 20px auto; /* Centre horizontalement et ajoute un peu d'espace vertical */
        padding: 10px; /* Ajoute un léger padding interne */
        background-color: #f9f9f9; /* Ajoute un fond léger pour le démarquer */
        border: 1px solid #ddd; /* Bordure subtile */
        border-radius: 8px; /* Coins arrondis pour un rendu plus propre */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Effet d'ombre pour plus de lisibilité */
    }

    #calendar a {
        color: black !important;
        text-decoration: none;
    }

    #calendar a:hover {
        color: black !important;
    }

    #eventTooltip {
        position: absolute;
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        z-index: 1000;
    }
</style>

<div id='calendar'></div>

@endsection

@extends('parent.parentDirecteurEmp')

@section('viewMessageSendOrReciveDirecteurSection')
<div class="container-fluid" style="max-width: 800px; margin: 0 auto;">
    <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="card-header text-center">
            <h5 class="fw-semibold">Chat avec {{$nom_emp}} {{$prenom_emp}}</h5>
        </div>
        <div class="card-body" id="chatbox" style="height: 600px; overflow-y: auto; background-color: #f8f9fa; border: 1px solid #ddd; padding: 20px;">
            <div id="loader" class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Chargement...</span>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex align-items-center">
            <!-- Input limité en hauteur -->
            <textarea id="userInput" class="form-control me-2" placeholder="Écrivez votre message..." style="resize: none; max-height: 100px; overflow-y: auto; flex: 1;"></textarea>
            <button type="button" id="sendBtn" class="btn btn-primary">Envoyer</button>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sockjs-client/1.5.1/sockjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/stomp.js/2.3.3/stomp.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
<script>
//------------------------------- websocket ----------------------------------------

    let stompClient = null;

// function connectWebSocket()
// {

//     const socket = new SockJS('http://localhost:8080/ws');
//     stompClient = Stomp.over(socket);
//     // let username = "carl";
//     const prenom_directeur = {!! json_encode($prenom_directeur) !!};
//     stompClient.connect({}, function (frame)
//     {
//         console.log('Connecté : ' + frame);

//         stompClient.subscribe('/topic/notifications/' + prenom_directeur, function (message) {
//             //showNotification(JSON.parse(message.body));
//         });
//     });

//     // Charger les anciennes notifications
//     //loadNotifications(prenom_directeur);
// }

function sendNotification()
{
    const username = {!! json_encode($prenom_directeur) !!};
    //console.log(username);
    const receiver = {!! json_encode($prenom_emp) !!};

    let content = "une nouvelle notification";

    // Obtenir la date actuelle
    let currentDate = new Date();

    // Convertir la date actuelle en chaîne de caractères
    let dateString = currentDate.toString();

    fetch('http://localhost:8080/api/notifications/send', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ sender: username, receiver: receiver, content: content , dateNotification:dateString})
    });
}

 window.onload = function() {
        connectWebSocket(); // Connexion automatique à WebSocket au chargement de la page
    };

//--------------------------------------------------------------------------------------------

$(document).ready(function()
{
            const sender_id = {{ Session::get('id_emp') }}; // ID du directeur ou utilisateur connecté
            const receiver_id = {{ $id_emp }}; // ID de l'employé

            console.log(sender_id);

            let sender_id_fixed = parseInt(sender_id, 10);
            let receiver_id_fixed = parseInt(receiver_id, 10);

            const nom_directeur = {!! json_encode($nom_directeur) !!};
            const prenom_directeur = {!! json_encode($prenom_directeur) !!};
            const id_directeur = {{$id_directeur}};
            const etat_directeur = {{$etat_directeur}};
            console.log(sender_id,receiver_id,nom_directeur,prenom_directeur,sender_id,receiver_id,id_directeur,etat_directeur);


            let isAtBottom = true;

    function checkIfAtBottom() {
        let chatbox = $('#chatbox');
        return chatbox.scrollTop() + chatbox.innerHeight() >= chatbox[0].scrollHeight;
    }

    function fetchMessages() {
        $.ajax({
            url: `http://localhost:8080/message/fetchMessage?sender_id=${sender_id}&receiver_id=${receiver_id}&sender_id2=${receiver_id}&receiver_id2=${sender_id}`,
            method: 'GET',
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(data) {
                let chatbox = $('#chatbox');
                let shouldScroll = checkIfAtBottom();
                chatbox.empty();

                data.forEach(message => {
                    let isCurrentUser = message.senderId == sender_id; // Vérifie si l'expéditeur est l'utilisateur actuel
                    let alignmentClass = isCurrentUser ? "text-end" : "text-start";
                    let bgColor = isCurrentUser ? "#001365" : "#2f2f2f"; // Différenciation des couleurs
                    let textAlign = isCurrentUser ? "right" : "left";

                    // Formater la date en HH:mm
                    let date = new Date(message.dateMessage);
                    let formattedTime = date.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });

                    chatbox.append(`
                        <div class="${alignmentClass} mb-2">
                            <div class="message-time">${formattedTime}</div>
                            <div style="display: inline-block; background-color: ${bgColor}; color: #fff; padding: 10px 15px; border-radius: 15px; max-width: 75%; word-wrap: break-word; text-align: ${textAlign};">
                                ${message.content_message}
                            </div>

                        </div>
                    `);
                });

                if (shouldScroll) {
                    chatbox.scrollTop(chatbox.prop("scrollHeight"));
                }
            },
            complete: function() {
                $('#loader').hide();
            }
        });
    }

    $('#chatbox').on('scroll', function() {
        isAtBottom = checkIfAtBottom();
    });

    fetchMessages();

    $('#sendBtn').on('click', function() {
        let content = $('#userInput').val().trim();
        console.log("sender = "+ sender_id);
        if (content !== "") {
            $.ajax({
                //url: `/send-messageV1`,
                url: `http://localhost:8080/message/send_message?content_message=${content}&sender_id=${sender_id_fixed}&receiver_id=${receiver_id_fixed}`,
                method: 'POST',
                // data: {
                //     _token: '{{ csrf_token() }}',
                //     sender_id: sender_id,
                //     receiver_id: receiver_id,
                //     content: content
                // },
                success: function() {
                    $('#userInput').val('');
                    fetchMessages();
                    sendNotification();
                    // $.ajax({
                    //     url:'/createNotificationMessageDirecteurToEmp',
                    //     method:'POST',
                    //     data:{
                    //         _token: '{{ csrf_token() }}',
                    //         sender_id: sender_id,
                    //         receiver_id: receiver_id,
                    //         nom_directeur: nom_directeur,
                    //         prenom_directeur: prenom_directeur,
                    //         id_directeur: id_directeur,
                    //         etat_directeur:etat_directeur
                    //     },
                    //     success: function(response) {
                    //         console.log('Notification envoyee');
                    //     }

                    // });

                }
            });
        }
    });

    //setInterval(fetchMessages, 3000);
});
</script>
@endsection



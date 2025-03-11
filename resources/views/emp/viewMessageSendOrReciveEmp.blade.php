@extends('parent.parentEmp')
@section('viewMessageSendOrReciveEmpSection')
<style>
    #chatbox {
    max-height: 400px;
    overflow-y: auto;
    padding: 10px;
}

.message-time {
    font-size: 12px;
    color: #bbb;
    margin-top: 2px;
    text-align: right;
}
.text-start .message-time {
    text-align: left;
}

</style>
<div class="container-fluid" style="max-width: 800px; margin: 0 auto;">
    <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="card-header text-center">
            <h5 class="fw-semibold">Chat avec {{$nom}} {{$prenom}}</h5>
        </div>
        <div class="card-body" id="chatbox" style="height: 600px; overflow-y: auto; background-color: #f8f9fa; border: 1px solid #ddd; padding: 15px;">
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
<style>
    .message-time {
    font-size: 12px;
    color: gray;
    margin-bottom: 5px;
}

.text-center {
    font-weight: bold;
}

.text-muted {
    font-size: 14px;
    color: #a0a0a0;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sockjs-client/1.5.1/sockjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/stomp.js/2.3.3/stomp.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
<script>



async function getEmployeeById(id_emp)
    {
        try {
            const response = await fetch(`http://127.0.0.1:8000/emp/${id_emp}`);
            if (!response.ok) {
                throw new Error('Erreur lors de la récupération des données');
            }
            const data = await response.json();
            //console.log('Données de l\'employé :', data);
            return data;
        } catch (error) {
            console.error('Erreur :', error);
            return null;
        }
    }

function sendMessage()
{
    const sender_id = {{Session::get('id_emp')}};
    const receiver_id = {{$id}};
    let content = $('#userInput').val().trim();
    // Obtenir la date actuelle
    let currentDate = new Date();

    // Convertir la date actuelle en chaîne de caractères
    let dateString = currentDate.toString();
    //console.log("hello");


    fetch('http://localhost:8080/message/realTime/sendMessage',{
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body:JSON.stringify({
            senderId:sender_id,
            receiverId:receiver_id,
            dateMessage:dateString,
            content_message:content
        })
    });
}
let lastMessageTime = null; // Stocke l'heure du dernier message affiché

function showMessage(message)
{
    let chatbox = $('#chatbox');
    let isCurrentUser = message.senderId == {{ Session::get('id_emp') }}; // Vérifie si l'expéditeur est l'utilisateur actuel
    let alignmentClass = isCurrentUser ? "text-end" : "text-start";
    let bgColor = isCurrentUser ? "#001365" : "#2f2f2f";
    let textAlign = isCurrentUser ? "right" : "left";

    // Convertir la date du message
    let messageTime = new Date(message.dateMessage);
    let formattedTime = messageTime.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
    let formattedDate = messageTime.toLocaleDateString('fr-FR', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' });

    // Vérifier si on doit afficher la date
    let shouldShowDate = lastMessageTime === null || messageTime.toDateString() !== lastMessageTime.toDateString();
    let shouldShowTime = lastMessageTime === null || (messageTime - lastMessageTime) >= (15 * 60 * 1000); // 30 min d'écart

    // Ajouter la date si nécessaire
    if (shouldShowDate) {
        chatbox.append(`
            <div class="text-center text-muted my-2">
                <small>${formattedDate}</small>
            </div>
        `);
    }

    // Ajouter le message
    chatbox.append(`
        <div class="${alignmentClass} mb-2">
            ${shouldShowTime ? `<div class="message-time">${formattedTime}</div>` : ""}
            <div style="display: inline-block; background-color: ${bgColor}; color: #fff; padding: 10px 15px; border-radius: 15px; max-width: 75%; word-wrap: break-word; text-align: ${textAlign};">
                ${message.content_message}
            </div>
        </div>
    `);

    lastMessageTime = messageTime; // Mettre à jour l'heure du dernier message affiché
    chatbox.scrollTop(chatbox.prop("scrollHeight")); // Scroll auto vers le bas
}


function sendNotification()
{
    //nom emp,prenom emp,id_emp,id_directeur,nom_dir,prenom dir,etat dir

    const nom_emp = {!! json_encode($nom_emp) !!};
    const prenom_emp = {!! json_encode($prenom_emp) !!};
    const id_emp = {{$id_emp}};
    //nom direteur
    const nom_directeur = {!! json_encode($nom) !!};
    const prenom_directeur = {!! json_encode($prenom) !!};

    //etat directeur
    const id_etat_personne = {{$id_etat_personne}};
    //id_directeur
    const id_directeur = {{$id}};

    console.log(id_directeur);


    let content = "Vous a envoyez un message";

    // Obtenir la date actuelle
    let currentDate = new Date();

    // Convertir la date actuelle en chaîne de caractères
    let dateString = currentDate.toString();

    //let url = `http://127.0.0.1:8000/viewMessageSendOrReciveDirecteur?nom=${nom_directeur}&prenom=${username}&id=${id}&etat=${etat}`
    let url = `http://127.0.0.1:8000/directeur/viewMessageSendOrReciveDirecteur?nom_emp=${nom_emp}&prenom_emp=${prenom_emp}&id_emp=${id_emp}&id_directeur=${id_directeur}&nom_dir=${nom_directeur}&prenom_dir=${prenom_directeur}&etat_dir=${id_etat_personne}`
    fetch('http://localhost:8080/api/notifications/send', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(
            {   sender: prenom_emp,
                receiver: prenom_directeur,
                content: content ,
                dateNotification:dateString,
                url:url
            })
    });

}


    //--------------------------------------------------------------------------------------------------------------------------
    $(document).ready(function() {
        const sender_id = {{Session::get('id_emp')}}; // ID du directeur ou utilisateur connecté
        const receiver_id = {{$id}}; // ID de l'employé
        const id_etat_personne = {{$id_etat_personne}};

        // si il vas dans directeur alors ca sera le session de emp connect
        //else le nom de emp cliquer
        const nom_emp = {!! json_encode($nom_emp) !!};
        const prenom_emp = {!! json_encode($prenom_emp) !!};
        const id_emp = {{$id_emp}};

        console.log("id"+id_emp);

        let sender_id_fixed = parseInt(sender_id, 10);
        let receiver_id_fixed = parseInt(receiver_id, 10);

        const id_directeur = {{$id}};

        //console.log(id_directeur);

        const nom_directeur = {!! json_encode($nom) !!};
        const prenom_directeur = {!! json_encode($prenom) !!};

        //console.log(sender_id, receiver_id);
        let isAtBottom = true;

        function checkIfAtBottom() {
            let chatbox = $('#chatbox');
            return chatbox.scrollTop() + chatbox.innerHeight() >= chatbox[0].scrollHeight;
        }

        function fetchMessages()
        {
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
                    let lastMessageTime = null;

                    data.forEach(message => {
                        let isCurrentUser = message.senderId == sender_id;
                        let alignmentClass = isCurrentUser ? "text-end" : "text-start";
                        let bgColor = isCurrentUser ? "#001365" : "#2f2f2f";
                        let textAlign = isCurrentUser ? "right" : "left";

                        // Convertir la date du message
                        let messageTime = new Date(message.dateMessage);
                        let formattedTime = messageTime.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
                        let formattedDate = messageTime.toLocaleDateString('fr-FR', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' });

                        // Vérifier si on doit afficher la date
                        let shouldShowDate = lastMessageTime === null || messageTime.toDateString() !== lastMessageTime.toDateString();
                        let shouldShowTime = lastMessageTime === null || (messageTime - lastMessageTime) >= (30 * 60 * 1000); // 30 min d'écart

                        // Ajouter la date si nécessaire
                        if (shouldShowDate) {
                            chatbox.append(`
                                <div class="text-center text-muted my-2">
                                    <small>${formattedDate}</small>
                                </div>
                            `);
                        }

                        // Ajouter le message
                        chatbox.append(`
                            <div class="${alignmentClass} mb-2">
                                ${shouldShowTime ? `<div class="message-time">${formattedTime}</div>` : ""}
                                <div style="display: inline-block; background-color: ${bgColor}; color: #fff; padding: 10px 15px; border-radius: 15px; max-width: 75%; word-wrap: break-word; text-align: ${textAlign};">
                                    ${message.content_message}
                                </div>
                            </div>
                        `);

                        lastMessageTime = messageTime;
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
            //console.log("sender = "+ sender_id);
            if (content !== "") {
                sendMessage();
                $.ajax({
                    success: function() {
                        $('#userInput').val('');
                        fetchMessages();
                        sendNotification();
                        // if (id_etat_personne == 7)
                        // {
                        //     $.ajax({
                        //         url:'/createNotificationMessageEmpToDirecteur',
                        //         method: 'POST',
                        //         data:{
                        //             _token: '{{ csrf_token() }}',
                        //             sender_id: sender_id,
                        //             receiver_id: receiver_id,
                        //             nom_emp:nom_emp,
                        //             prenom_emp:prenom_emp,
                        //             id_emp:id_emp,
                        //             id_directeur:id_directeur,
                        //             nom_directeur:nom_directeur,
                        //             prenom_directeur:prenom_directeur,
                        //             etat_directeur:id_etat_personne
                        //         },
                        //         success: function(response) {
                        //             console.log('Notification envoyee');
                        //         }
                        //     });
                        // }
                        // else
                        // {
                        //     $.ajax({
                        //         url:'/createNotificationMessageEmpToEmp',
                        //         method: 'POST',
                        //         data:{
                        //             _token: '{{ csrf_token() }}',
                        //             sender_id: sender_id,
                        //             receiver_id: receiver_id,
                        //             nom_emp:nom_emp,
                        //             prenom_emp:prenom_emp,
                        //             id_emp:id_emp,
                        //             etat_personne:id_etat_personne
                        //         },
                        //         success: function(response) {
                        //             console.log('Notification envoyee');
                        //         }
                        //     });
                        // }


                    }
                });
            }
        });

        //setInterval(fetchMessages, 3000);
    });
</script>
@endsection

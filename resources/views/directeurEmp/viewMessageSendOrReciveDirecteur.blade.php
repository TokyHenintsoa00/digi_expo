@extends('parent.parentDirecteurEmp')

@section('viewMessageSendOrReciveDirecteurSection')
<div class="container-fluid" style="max-width: 600px; margin: 0 auto;">
    <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="card-header text-center">
            <h5 class="fw-semibold">Chat avec {{$nom_emp}} {{$prenom_emp}}</h5>
        </div>
        <div class="card-body" id="chatbox" style="height: 400px; overflow-y: auto; background-color: #f8f9fa; border: 1px solid #ddd; padding: 15px;">
            <div id="loader" class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Chargement...</span>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex align-items-center">
            <!-- Input limité en hauteur -->
            <textarea id="userInput" class="form-control me-2" placeholder="Écrivez votre message..." style="resize: none; max-height: 80px; overflow-y: auto; flex: 1;"></textarea>
            <button type="button" id="sendBtn" class="btn btn-primary">Envoyer</button>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script>
    $(document).ready(function() {
        const sender_id = {{ Session::get('id_emp') }}; // ID du directeur ou utilisateur connecté
        const receiver_id = {{ $id_emp }}; // ID de l'employé

        console.log(sender_id);


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
        url: `/fetch-messagesV1/${sender_id}/${receiver_id}`,
        method: 'GET',
        beforeSend: function() {
            $('#loader').show();
        },
        success: function(data) {
            let chatbox = $('#chatbox');
            let shouldScroll = checkIfAtBottom();
            chatbox.empty();

            data.forEach(message => {
                if (message.is_sent) {
                    // Message envoyé (aligné à droite)
                    chatbox.append(`
                           <div class="text-end mb-2">
                                <div style="display: inline-block; background-color: #001365; color: #fff; padding: 10px 15px; border-radius: 15px; max-width: 75%; word-wrap: break-word; direction: ltr; text-align: left;">
                                    ${message.content}
                                </div>
                            </div>
                    `);
                } else {
                    // Message reçu (aligné à gauche)
                    chatbox.append(`
                        <div class="text-start mb-2">
                            <div style="display: inline-block; background-color: #2f2f2f; color: #fff; padding: 10px 15px; border-radius: 15px; max-width: 75%; word-wrap: break-word;">
                                ${message.content}
                            </div>
                        </div>
                    `);
                }
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
    if (content !== "") {
        $.ajax({
            url: `/send-messageV1`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                sender_id: sender_id,
                receiver_id: receiver_id,
                content: content
            },
            success: function() {
                $('#userInput').val('');
                fetchMessages();
                $.ajax({
                    url:'/createNotificationMessageDirecteurToEmp',
                    method:'POST',
                    data:{
                        _token: '{{ csrf_token() }}',
                        sender_id: sender_id,
                        receiver_id: receiver_id,
                        nom_directeur: nom_directeur,
                        prenom_directeur: prenom_directeur,
                        id_directeur: id_directeur,
                        etat_directeur:etat_directeur
                    },
                    success: function(response) {
                        console.log('Notification envoyee');
                    }

                });

            }
        });
    }
});

setInterval(fetchMessages, 3000);
});
</script>
@endsection



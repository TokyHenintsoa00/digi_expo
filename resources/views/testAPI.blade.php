<h2>Notifications Privées en Temps Réel</h2>

<label for="username">Votre ID :</label>
<input type="text" id="username">

<label for="receiver">Envoyer à :</label>
<input type="text" id="receiver">

<label for="message">Message :</label>
<input type="text" id="message">

<button onclick="sendNotification()">Envoyer</button>

<h3>Notifications Reçues :</h3>
<ul id="notifications"></ul>
<button onclick="connectWebSocket()">Se Connecter</button>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sockjs-client/1.5.1/sockjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/stomp.js/2.3.3/stomp.min.js"></script>

<script>
   let stompClient = null;

// Fonction pour se connecter au WebSocket
function connectWebSocket(username) {
    const socket = new SockJS('http://localhost:8080/ws'); // Remplace par l'URL de ton serveur Spring WebSocket
    stompClient = Stomp.over(socket);

    stompClient.connect({}, function (frame) {
        console.log('Connecté : ' + frame);

        // S'abonner au canal de notifications
        stompClient.subscribe('/topic/notifications/' + username, function (message) {
            showNotification(JSON.parse(message.body));
        });
    });
}

// Fonction pour envoyer une notification via l'API REST de Spring
function sendNotification(sender, receiver, content) {
    fetch('http://localhost:8080/api/notifications/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            sender: sender,
            receiver: receiver,
            content: content
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Notification envoyée:', data);
    })
    .catch(error => {
        console.error('Erreur d\'envoi de la notification:', error);
    });
}

// Fonction pour afficher la notification sur la page
function showNotification(notification) {
    const notificationList = document.getElementById("notifications");
    const newNotification = document.createElement("li");
    newNotification.innerText = `De ${notification.sender} : ${notification.content}`;
    notificationList.appendChild(newNotification);
}

// // Exemple d'appel, connecte un utilisateur à WebSocket
// connectWebSocket('user2');  // Remplace 'user2' par le nom d'utilisateur réel

// Envoie une notification de 'user1' à 'user2'
sendNotification('user1', 'user2', 'Message en temps réel!');
</script>
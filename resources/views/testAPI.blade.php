{{-- <h2>Notifications Privées en Temps Réel</h2>

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
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>

<script>
   let stompClient = null;

// Fonction pour se connecter au WebSocket
function connectWebSocket() {
    let username = document.getElementById("username").value;

    const socket = new SockJS('http://localhost:8080/ws'); // Remplace par l'URL de ton serveur Spring WebSocket
    stompClient = Stomp.over(socket);

    stompClient.connect({}, function (frame) {
        console.log('Connecté : ' + frame);

        // S'abonner au canal de notifications
        stompClient.subscribe('/topic/notifications/' + username, function (message) {
            console.log("Message reçu via WebSocket :", message.body);
            showNotification(JSON.parse(message.body));
        });
    });
}




// Fonction pour envoyer une notification via l'API REST de Spring
function sendNotification() {
    let username = document.getElementById("username").value;
    let receiver = document.getElementById("receiver").value;
    let content = document.getElementById("message").value;

    console.log("user:"+ username);


    fetch('http://localhost:8080/api/notifications/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            sender: username,
            receiver: receiver,
            content: content
        })
    });
}


// // Fonction pour afficher la notification sur la page
function showNotification(notification) {
    console.log("Notification reçue :", notification); // Ajout du log

    const notificationList = document.getElementById("notifications");
    const newNotification = document.createElement("li");

    // Vérifie quel champ contient le nom d'utilisateur
    const sender = notification.username || notification.sender || "Inconnu";
    newNotification.innerText = `De ${sender} : ${notification.content}`;

    notificationList.appendChild(newNotification);
}

// Fonction pour afficher la notification sur la page
// Fonction pour afficher la notification sur la page




</script> --}}

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
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>

<script>
    let stompClient = null;

    // ✅ Fonction pour se connecter au WebSocket
    function connectWebSocket() {

    const socket = new SockJS('http://localhost:8080/ws');
    stompClient = Stomp.over(socket);
    // let username = "carl";
    let username = document.getElementById("username").value;
    stompClient.connect({}, function (frame)
    {
        console.log('Connecté : ' + frame);

        stompClient.subscribe('/topic/notifications/' + username, function (message) {
            showNotification(JSON.parse(message.body));
        });
    });

    // Charger les anciennes notifications
    loadNotifications(username);
}


    // ✅ Charger les notifications depuis MongoDB
    function loadNotifications(username) {
    fetch(`http://localhost:8080/api/notifications/${username}`)
        .then(response => response.json())
        .then(notifications => {
            notifications.forEach(showNotification);
        })
        .catch(error => console.error('Erreur chargement des notifications:', error));
}


    // ✅ Fonction pour envoyer une notification via l'API REST
    function sendNotification()
{
    let username = document.getElementById("username").value;
    //console.log(username);

    let receiver = document.getElementById("receiver").value;
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



    // ✅ Fonction pour afficher la notification sur la page
    function showNotification(notification) {
        //console.log("📩 Affichage de la notification :", notification);

        const notificationList = document.getElementById("notifications");
        const newNotification = document.createElement("li");

        // Vérifie le bon champ pour récupérer le sender
        const sender = notification.sender || "Inconnu";

        newNotification.innerText = `📢 De ${sender} : ${notification.content}`;

         // Ajouter la notification au début de la liste (au lieu de la fin)
        notificationList.insertBefore(newNotification, notificationList.firstChild);

        //notificationList.appendChild(newNotification);
    }

    // window.onload = function() {
    //     connectWebSocket(); // Connexion automatique à WebSocket au chargement de la page
    // };

</script>

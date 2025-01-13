@extends('parent.parentHome')
@section('demandeAideSection')

<div class="container-fluid" style="max-width: 600px; margin: 0 auto;">
    <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="card-header text-center">
            <h5 class="fw-semibold">Besoin d'aide? Discutez avec notre chatbot!</h5>
        </div>
        <div class="card-body" id="chatbox" style="height: 400px; overflow-y: auto; background-color: #f8f9fa; border: 1px solid #ddd; padding: 15px;">
            <!-- Chat messages will appear here -->
        </div>
        <div class="card-footer d-flex">
            <input type="text" id="userInput" class="form-control me-2" placeholder="Écrivez votre message..." style="flex: 1;">
            <button type="button" id="sendBtn" class="btn btn-primary">Envoyer</button>
        </div>
    </div>
</div>

<script>
    document.getElementById('sendBtn').addEventListener('click', function() {
        let userInput = document.getElementById('userInput').value;
        if (userInput.trim() !== "") {
            let chatbox = document.getElementById('chatbox');
            let userMessage = `<div class="text-end mb-2"><strong>Vous:</strong> ${userInput}</div>`;
            chatbox.innerHTML += userMessage;
            document.getElementById('userInput').value = "";
            chatbox.scrollTop = chatbox.scrollHeight;

            // Here you can add the logic to send the user's message to the chatbot backend
        }
    });
</script>

@endsection

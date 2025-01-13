<!DOCTYPE html>
<html>
<head>
    <title>Votre compte administrateur</title>
</head>
<body>
    <h1>Bonjour {{ $prenom }} !</h1>
    <p>Votre compte administrateur a été créé avec succès. Voici vos informations de connexion :</p>
    <ul>
        <li>Email : {{ $email }}</li>
        <li>Mot de passe : {{ $password }}</li>
    </ul>
    <p>Veuillez vous connecter et changer votre mot de passe dès que possible pour sécuriser votre compte.</p>
    <p>Merci,</p>
    <p>L'équipe support</p>
</body>
</html>

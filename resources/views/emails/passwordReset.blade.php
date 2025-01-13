<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation de votre mot de passe</title>
</head>
<body>
    <h1>Réinitialisation de votre mot de passe</h1>
    <p>Vous avez demandé une réinitialisation de mot de passe. Cliquez sur le lien ci-dessous pour en créer un nouveau :</p>
    <a href="{{ url('/viewResetPassword/'.$token) }}">Réinitialiser le mot de passe</a>
    <p>Si vous n'avez pas demandé de réinitialisation, ignorez cet e-mail.</p>
</body>
</html>
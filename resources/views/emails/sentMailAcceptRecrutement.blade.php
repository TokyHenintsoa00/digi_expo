<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recrutement d'employer</title>
</head>
<body>
    <h1>Recutement d'employer</h1>
    <p>Bonjour {{$prenom_emp}}</p>
    <p>Felicitaion, vous avez été par le directeur du stand de {{$nom_stand}}</p>
    <p>Votre matricule est le {{$matricule_emp}}</p>
    <a href="{{ url('/viewauthentificationEmp/') }}">Espace employe</a>
</body>
</html>
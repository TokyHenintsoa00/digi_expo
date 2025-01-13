<!DOCTYPE html>
<html>
<head>
    <title>Permission de stand</title>
</head>
<body>
    <h1>Permission de stand par l'administrateur</h1>
    <p>Bonjour {{$prenom_emp}} </p>
    <p>Votre demande de permission pour faire une exposition a ete accepte cliquez sur le liens pour consultez votre espace employe en vous connectant</p>
    <p>Votre matricule est le {{$matricule_emp}}</p>
    <a href="{{ url('/authentification/') }}">Espace employe</a>
</body>
</html>
@extends('parent.parentHome')
@section('permissionDeFaireUnStandSection')


<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Formulaire d'exposition </h5>

            <!-- Afficher le message de succès -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {!! session('success') !!}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('error') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="/getInsertPermissionStandEmp" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row"> <!-- Row for both forms -->
                            <!-- Formulaire du stand -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nomStand" class="form-label">Nom de stand</label>
                                    <input type="text" class="form-control" id="nomStand" aria-describedby="nomHelp" name="nom_stand" required>
                                </div>

                                <div class="mb-3">
                                    <label for="faculteSelect" class="form-label">Votre categorie</label>
                                    <select class="form-select" id="faculteSelect" aria-label="Select faculté" name="id_categorie" required>
                                        <option selected disabled>Choisissez votre faculté</option>
                                        @foreach ($categorie as $list_categorie)
                                        <option value="{{$list_categorie->id_categorie}}">{{$list_categorie->nom_categorie}}</option>
                                        @endforeach
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="nomStand" class="form-label">Nom de la categorie</label>
                                    <input type="text" class="form-control" id="nomStand" aria-describedby="nomHelp" name="nom_categorie_stand" required>
                                </div>

                                <div class="mb-3">
                                    <label for="descriptionStand" class="form-label">Description du stand</label>
                                    <textarea class="form-control" id="descriptionStand" rows="4" placeholder="Décrivez votre stand ici..." name="description_stand" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="emailEmploye" class="form-label">Date du debut de l'exposition</label>
                                    <input type="date" class="form-control" id="emailEmploye" aria-describedby="emailHelp" name="date_debut" required>
                                </div>

                                <div class="mb-3">
                                    <label for="emailEmploye" class="form-label">Date de fin de l'exposition</label>
                                    <input type="date" class="form-control" id="emailEmploye" aria-describedby="emailHelp" name="date_fin" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nomStand" class="form-label">image de stand</label>
                                    <input type="file" class="form-control" id="img_stand" name="img_stand" accept="image/*" required>
                                </div>

                            </div>

                            <!-- Formulaire de l'employé -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nomEmploye" class="form-label">Votre nom</label>
                                    <input type="text" class="form-control" id="nomEmploye" aria-describedby="nomHelp" name="nom_employe" required>
                                </div>

                                <div class="mb-3">
                                    <label for="prenomEmploye" class="form-label">Votre prenom</label>
                                    <input type="text" class="form-control" id="prenomEmploye" aria-describedby="prenomHelp" name="prenom_employe" required>
                                </div>

                                <div class="mb-3">
                                    <label for="prenomEmploye" class="form-label">Date de naissance</label>
                                    <input type="date" class="form-control" id="prenomEmploye" aria-describedby="prenomHelp" name="date_naissance" required>
                                </div>

                                <div class="mb-3">
                                    <label for="emailEmploye" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailEmploye" aria-describedby="emailHelp" name="email_employe" required>
                                </div>


                            </div>
                        </div>

                        <input type="submit" value="Soumettre" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

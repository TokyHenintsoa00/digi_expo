{{-- @extends('parent.ParentAdmin')
@section('allListSection')

<div class="container-fluid">
    <div class="row">
        <!-- Section de la liste des employés -->
        <div class="col-md-8">
            <h1>Liste de tout les personnels</h1>

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

            <!-- Barre de recherche -->
            <div class="mb-3">
                <form id="searchForm" class="d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="searchInput" name="search" class="form-control" placeholder="Rechercher un employé..." value="{{ request('query') }}">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Date de membre</th>
                        <th>État</th>
                    </tr>
                </thead>
                <tbody id="employeeList">
                    @foreach ($infoEmp as $list_infoEmp)
                        <tr>
                            <td>{{$list_infoEmp->nom_emp}}</td>
                            <td>{{$list_infoEmp->prenom_emp}}</td>
                            <td>{{$list_infoEmp->email}}</td>
                            <td>{{$list_infoEmp->date_membre}}</td>
                            <td>
                                @if ($list_infoEmp->id_etat == 2)
                                    <span class="text-success fw-semibold">Editeur</span>
                                @elseif ($list_infoEmp->id_etat == 8)
                                    <span class="text-danger fw-semibold">licencié</span>
                                @elseif ($list_infoEmp->id_etat == 9)
                                    <span class="text-warning fw-semibold">Demissionné</span>
                                @elseif ($list_infoEmp->id_etat == 7)
                                    <span class="text-success fw-semibold">Directeur</span>
                                @elseif ($list_infoEmp->id_etat == 10)
                                    <span class="text-warning fw-semibold"> licencié</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Section de la carte -->

        <!-- Section de la carte -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mt-5" style="width: 80%; margin: auto;">
                <div class="card-header bg-primary text-white text-center py-2">
                    <h6 class="mb-0" style="font-size: 1rem; color:#ffffff">Nombre de Stands</h6>
                </div>
                <div class="card-body text-center py-3">
                    <h2 class="fw-bold text-primary" style="font-size: 2rem;">
                        @foreach ($nombre_stand as $list_nombre_stand)
                            {{$list_nombre_stand->nombre_stand}}
                        @endforeach
                    </h2>
                    <p class="text-muted" style="font-size: 0.9rem;">Total de stands créés</p>
                    <a href="{{route('viewInfoStand')}}" class="btn btn-outline-primary btn-sm mt-2">
                        Voir plus d'informations
                    </a>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Script AJAX -->
<script>
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const searchValue = document.getElementById('searchInput').value;

        // Envoyer la requête AJAX
        fetch('{{ route("search") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ search: searchValue })
        })
        .then(response => response.json())
        .then(data => {
            const employeeList = document.getElementById('employeeList');
            employeeList.innerHTML = '';

            // Mise à jour de la liste des employés
            data.forEach(employee => {
                let row = `
                    <tr>
                        <td>${employee.nom_emp}</td>
                        <td>${employee.prenom_emp}</td>
                        <td>${employee.email}</td>
                        <td>${employee.date_membre}</td>
                        <td>
                            ${
                                employee.id_etat == 2
                                    ? '<span class="text-success fw-semibold">Editeur </span>'
                                    : employee.id_etat == 8
                                    ? '<span class="text-danger fw-semibold"> licencié</span>'
                                    : employee.id_etat == 9
                                    ? '<span class="text-warning fw-semibold">Demmissionné</span>'
                                    : employee.id_etat == 7
                                    ? '<span class="text-success fw-semibold">Responsqble</span>'
                                    : employee.id_etat == 10
                                    ? '<span class="text-warning fw-semibold"> licencié</span>'
                                    : ''
                            }
                        </td>
                    </tr>
                `;
                employeeList.innerHTML += row;
            });
        })
        .catch(error => console.error('Erreur:', error));
    });
</script>
@endsection --}}


@extends('parent.ParentAdmin')
@section('allListSection')

<div class="container-fluid">
    <div class="row">
        <!-- Section de la liste des employés -->
        <div class="col-md-8">
            <h1>Liste de tout les personnels</h1>

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

            <!-- Barre de recherche -->
            <div class="mb-3">
                <form id="searchForm" class="d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="searchInput" name="search" class="form-control" placeholder="Rechercher un employé..." value="{{ request('query') }}">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 20%;">Nom</th>
                        <th style="width: 20%;">Prénom</th>
                        <th style="width: 30%;">Email</th>
                        <th style="width: 15%;">Date</th>
                        <th style="width: 15%;">État</th>
                    </tr>
                </thead>
                <tbody id="employeeList">
                    @foreach ($infoEmp as $list_infoEmp)
                        <tr>
                            <td class="text-truncate" style="max-width: 150px;">{{$list_infoEmp->nom_emp}}</td>
                            <td class="text-truncate" style="max-width: 150px;">{{$list_infoEmp->prenom_emp}}</td>
                            <td class="text-truncate" style="max-width: 250px;">{{$list_infoEmp->email}}</td>
                            <td>{{$list_infoEmp->date_membre}}</td>
                            <td>
                                @if ($list_infoEmp->id_etat == 2)
                                    <span class="text-success fw-semibold">Editeur</span>
                                @elseif ($list_infoEmp->id_etat == 8)
                                    <span class="text-danger fw-semibold">Licencié</span>
                                @elseif ($list_infoEmp->id_etat == 9)
                                    <span class="text-warning fw-semibold">Démissionnaire</span>
                                @elseif ($list_infoEmp->id_etat == 7)
                                    <span class="text-success fw-semibold">Responsable</span>
                                @elseif ($list_infoEmp->id_etat == 10)
                                    <span class="text-warning fw-semibold">Directeur licencié</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Section de la carte -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mt-5" style="width: 80%; margin: auto;">
                <div class="card-header bg-primary text-white text-center py-2">
                    <h6 class="mb-0" style="font-size: 1rem; color:#ffffff">Nombre de Stands</h6>
                </div>
                <div class="card-body text-center py-3">
                    <h2 class="fw-bold text-primary" style="font-size: 2rem;">
                        @foreach ($nombre_stand as $list_nombre_stand)
                            {{$list_nombre_stand->nombre_stand}}
                        @endforeach
                    </h2>
                    <p class="text-muted" style="font-size: 0.9rem;">Total de stands créés</p>
                    <a href="{{route('viewInfoStand')}}" class="btn btn-outline-primary btn-sm mt-2">
                        Voir plus d'informations
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Script AJAX -->
<script>
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const searchValue = document.getElementById('searchInput').value;

        // Envoyer la requête AJAX
        fetch('{{ route("search") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ search: searchValue })
        })
        .then(response => response.json())
        .then(data => {
            const employeeList = document.getElementById('employeeList');
            employeeList.innerHTML = '';

            // Mise à jour de la liste des employés
            data.forEach(employee => {
                let row = `
                    <tr>
                        <td class="text-truncate" style="max-width: 150px;">${employee.nom_emp}</td>
                        <td class="text-truncate" style="max-width: 150px;">${employee.prenom_emp}</td>
                        <td class="text-truncate" style="max-width: 250px;">${employee.email}</td>
                        <td>${employee.date_membre}</td>
                        <td>
                            ${
                                employee.id_etat == 2
                                    ? '<span class="text-success fw-semibold">Editeur</span>'
                                    : employee.id_etat == 8
                                    ? '<span class="text-danger fw-semibold">Licencié</span>'
                                    : employee.id_etat == 9
                                    ? '<span class="text-warning fw-semibold">Démissionnaire</span>'
                                    : employee.id_etat == 7
                                    ? '<span class="text-success fw-semibold">Responsable</span>'
                                    : employee.id_etat == 10
                                    ? '<span class="text-warning fw-semibold"> Directeur licencié</span>'
                                    : ''
                            }
                        </td>
                    </tr>
                `;
                employeeList.innerHTML += row;
            });
        })
        .catch(error => console.error('Erreur:', error));
    });
</script>
@endsection

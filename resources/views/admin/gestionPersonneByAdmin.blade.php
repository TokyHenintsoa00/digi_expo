@extends('parent.ParentAdmin')
@section('gestionPersonnelByAdminSection')

<h1>Liste de validation</h1>
<div class="container-fluid">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="row">

            <center>
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                          Gestion des personnels
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">Gérez vos licensiment</h5>
                          <p class="card-text">Vérifiez que toutes les informations sont correctes avant de finaliser chaque licensiment.</p>
                          <a href="{{route('viewLicensimentEmpByAdmin')}}" class="btn btn-primary">Confirmer licensiment</a>
                        </div>
                      </div>
                </div>
            </center>

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
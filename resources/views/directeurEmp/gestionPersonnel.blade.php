@extends('parent.parentDirecteurEmp')
@section('gestionPersonnelSection')

<div class="container-fluid">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="row">

            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                       Recrutement d'editeur
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Ajout de recrutement d'editeur</h5>
                      <p class="card-text">Vérifiez que toutes les informations sont correctes avant de finaliser chaque ajout de recrutement.</p>
                      <a href="{{route('viewRecrutementEmp')}}" class="btn btn-primary">Confirmer recrutement</a>
                    </div>
                  </div>
            </div>




            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        Licenciement  d'editeur
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérez vos licenciement</h5>
                        <p class="card-text">Vérifiez que toutes les informations sont correctes avant de finaliser chaque licenciement.</p>
                        <a href="{{route('viewLicensimentEmployer')}}" class="btn btn-primary">Confirmer licensiment</a>
                    </div>
                    </div>
            </div>


            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        Demission d'editeur
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gérez vos Demission de votre editeur</h5>
                        <p class="card-text">Vérifiez que toutes les informations sont correctes avant de finaliser chaque demission.</p>
                        <a href="{{route('viewDemissionEmployer')}}" class="btn btn-primary">Confirmer les demission</a>
                    </div>
                    </div>
            </div>


            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        List et nombre d'editeur
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Voir les listes des editeur </h5>
                        <p class="card-text">Les liste des editeur et nombre d'editeur par stand.</p>
                        <a href="{{route('viewListEmpAndNombreEmpParStand')}}" class="btn btn-primary">Voir la liste</a>
                    </div>
                    </div>
            </div>



          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
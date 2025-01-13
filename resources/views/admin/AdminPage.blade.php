@extends('parent.ParentAdmin')
@section('AdminSection')

<h1>Liste de validation</h1>
<div class="container-fluid">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="row">


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                      Validation de permission de stand
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Validez les permissions de stand des clients</h5>
                      <p class="card-text">Examinez les demandes de permission de stand et approuvez ou rejetez les demandes selon les critères établis.</p>
                      <a href="/viewValidationPermissionStand" class="btn btn-primary">Valider maintenant</a>
                    </div>
                  </div>
            </div>



            <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    Validation de recrutement
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Validez les recrutement des directeurs </h5>
                    <p class="card-text">Vérifiez les données soumises et approuvez ou rejetez la demande de validation.</p>
                    <a href="/viewValidationRecrutementEmp" class="btn btn-primary">Valider maintenant</a>
                  </div>
                </div>
              </div>






          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
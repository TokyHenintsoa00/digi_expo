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
                      <a href="{{route('viewValidationPermissionStand')}}" class="btn btn-primary">Valider maintenant</a>
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
                    <a href="{{route('viewValidationRecrutementEmp')}}" class="btn btn-primary">Valider maintenant</a>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    Validation de galerie photo
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Validez les permission de publication de(s) des directeurs </h5>
                    <p class="card-text">Vérifiez les données soumises et approuvez ou rejetez la demande de validation.</p>
                    <a href="{{route('viewValidationGaleriePhoto')}}" class="btn btn-primary">Valider maintenant</a>
                  </div>
                </div>
              </div>


              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    Validation de galerie video
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Validez les recrutement des directeurs </h5>
                    <p class="card-text">Vérifiez les données soumises et approuvez ou rejetez la demande de validation.</p>
                    <a href="{{route('viewGalerieVideo')}}" class="btn btn-primary">Valider maintenant</a>
                  </div>
                </div>
              </div>


                <div class="col-md-4">
                    <div class="card">
                    <div class="card-header">
                        Validation de conference client
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Validez les recrutement des directeurs </h5>
                        <p class="card-text">Vérifiez les données soumises et approuvez ou rejetez la demande de validation.</p>
                        <a href="{{route('viewValidationVideoConferenceClient')}}" class="btn btn-primary">Valider maintenant</a>
                    </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card">
                    <div class="card-header">
                        Validation de temoignage
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Validez les recrutement des directeurs </h5>
                        <p class="card-text">Vérifiez les données soumises et approuvez ou rejetez la demande de validation.</p>
                        <a href="{{route('viewValidationTemoigage')}}" class="btn btn-primary">Valider maintenant</a>
                    </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                    <div class="card-header">
                        Validation de conference
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Validez les recrutement des directeurs </h5>
                        <p class="card-text">Vérifiez les données soumises et approuvez ou rejetez la demande de validation.</p>
                        <a href="{{route('viewPermissionConference')}}" class="btn btn-primary">Valider maintenant</a>
                    </div>
                    </div>
                </div>



          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
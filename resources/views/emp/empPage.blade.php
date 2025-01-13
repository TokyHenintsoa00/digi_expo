@extends('parent.parentEmp')
@section('empPageSection')

<h1>Validations</h1>
<div class="container-fluid">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="row">

            <center>

                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                            Validation des stands dans l'espace client
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">Validez et confirmez vos stands afin qu'ils soient visibles pour les clients</h5>
                          <p class="card-text">Assurez-vous que toutes les informations sont exactes avant la validation finale.</p>
                          <a href="{{route('viewStandEmp')}}" class="btn btn-primary">Valider maintenant</a>
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

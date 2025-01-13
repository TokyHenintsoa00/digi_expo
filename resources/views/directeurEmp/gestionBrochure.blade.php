@extends('parent.parentDirecteurEmp')
@section('gestionBrochureSection')

<h1>Validations finales</h1>
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <center>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Modification et publication de votre brochure
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Personnalisez et publiez votre brochure pour une visibilité optimale auprès de vos clients</h5>
                                    <p class="card-text">Assurez-vous que toutes les informations de la brochure sont correctes avant de la mettre en ligne.</p>
                                    <a href="{{route('viewChoixDeStandBrochure')}}" class="btn btn-primary">Publier maintenant</a>
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

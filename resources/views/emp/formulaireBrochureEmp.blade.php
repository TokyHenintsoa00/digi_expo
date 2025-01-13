@extends('parent.parentEmp')
@section('formulaireBrochureEmpSection')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">formulaire d'ajout de brochure</strong>
            </div>
            <div class="card-body">
                  <!-- Afficher le message de succès -->
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
                <form action="{{route('publierBrochureEmp')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 mb-3">
                            <label for="inputPassword4">Nom brochure</label>
                            <input type="text" name="nom_brochure" id="" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="inputPassword4">Fichier du brochure</label>
                            <input type="file" class="form-control" id="img_stand" name="fichier" accept="image/*,application/pdf" required>                                </div>

                        </div>
                        <input type="hidden" name="id_info_type_stand" value="{{$id_info_type_stand}}">
                    <input type="submit" class="btn btn-primary" value="Publier">
                </form>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->


@endsection
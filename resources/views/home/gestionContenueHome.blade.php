@extends('parent.parentHome')
@section('gestionContenueHomeSection')

<h1>Galleride de stand</h1>
<div class="container-fluid">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="row">


            @if (session('success'))
                   <div class="alert alert-success" role="alert">
                       {!! session('success') !!}
                   </div>
            @endif

                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                           Galerie Photo
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">Validez et confirmez vos contenue photos afin qu'ils soient visibles pour les clients</h5>
                          <p class="card-text">Assurez-vous que toutes les informations sont exactes avant la validation finale.</p>

                          <form action="{{route('getContenueStand')}}" method="get" >
                                <input type="hidden" name="id_stand" value="{{$id_stand}}">
                                <input type="submit" value="Voir la galerie photo" class="btn btn-primary">
                          </form>
                        </div>
                      </div>
                </div>



                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                           Galerie video
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Nous vous encourageons à valider et à confirmer les modifications apportées à vos contenus photo afin qu'ils soient accessibles aux clients.</h5>
                            <p class="card-text">Assurez-vous que toutes les informations modifiées sont exactes avant de procéder à la validation finale.</p>
                            <form action="{{route('viewContenueVideo')}}" method="get" >
                                <input type="hidden" name="id_stand" value="{{$id_stand}}">
                                <input type="submit" value="Voir la galerie video" class="btn btn-primary">
                            </form>
                        </div>
                      </div>
                </div>


          </div>
        </div>
      </div>
    </div>
  </div>




@endsection
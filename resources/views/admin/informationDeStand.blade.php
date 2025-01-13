@extends('parent.ParentAdmin')
@section('informationDeStandSection')

<h1>Liste des stands</h1>
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        <!-- First row of 3 cards -->
                        <div class="row">
                            @foreach ($stand as $list_stand_success)
                            <div class="col-md-4 mb-4">
                                <div class="card transition-effect">
                                    <img src="../assets/{{$list_stand_success->img_stand}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$list_stand_success->nom_stand}}</h4>
                                        <p class="card-text">{{$list_stand_success->description_stand}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
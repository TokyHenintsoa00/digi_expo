@extends('parent.parentEmp')
@section('choixStandBrochureEmp')


<h1>Liste de vos stands</h1>
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {!! session('success') !!}
                        </div>
                        @endif
                        <!-- First row of 3 cards -->
                        <div class="row">
                            @foreach ($standSuccessByIdEmp as $list_standSuccessByIdEmp)
                            <div class="col-md-4 mb-4">
                                <div class="card transition-effect">
                                    <img src="../assets/{{$list_standSuccessByIdEmp->img_stand}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$list_standSuccessByIdEmp->nom_stand}}</h4>
                                        <p class="card-text">{{$list_standSuccessByIdEmp->description_stand}}</p>
                                       <form action="{{route('viewChoixContenuePourBrochureEmp')}}" method="GET">
                                            <input type="hidden" name="id_stand" value="{{$list_standSuccessByIdEmp->id_stand}}">
                                            <input type="submit" value="Voir les contenues" class="btn btn-primary">
                                       </form>
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
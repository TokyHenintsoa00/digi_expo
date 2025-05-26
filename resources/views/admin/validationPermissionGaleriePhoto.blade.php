@extends('parent.ParentAdmin')
@section('galeriePhotoSection')
<h1>Liste de validation des galerie photos</h1>

<div class="col-12">

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
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nom Stand</th>
                <th>Type de photo</th>
                <th>description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissionGaleriePhoto as $list_galerie_photo)
                <tr>
                    <td>{{$list_galerie_photo->nom_stand}}</td>
                    <td>{{$list_galerie_photo->nom_type_stand}}</td>
                    <td>{{$list_galerie_photo->description_info_type_stand }}</td>

                    <td>
                        @if ($list_galerie_photo->id_etat ==1)
                        <div class="d-flex align-items-center gap-2">
                            <p class="text-danger fw-semibold">En attente</p>
                        </div>
                        @endif
                    </td>
                    <td>
                        <form id="validationForm" action="{{route('validePermissionGalerie')}}" method="POST">
                            @csrf
                                <input type="hidden" name="id_permission_galerie" value="{{$list_galerie_photo->id_permission_gallerie_photos}}">
                                <input type="submit" value="Valider" class="btn btn-success m-1">
                        </form>
                    </td>
                    <td>
                        <form action="#" method="POST">
                            @csrf
                                {{-- web socket refuser fa tsy mila manao an ny controler --}}
                            <input type="submit" value="Refuser" class="btn btn-danger m-1">
                        </form>

                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
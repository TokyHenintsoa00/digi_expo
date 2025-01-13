{{-- @extends('parent.parentDirecteurEmp')
@section('formulaireDeModificationBrochureSection')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">Formulaire de modification de brochure</strong>
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

                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputPassword4">Nom brochure</label>
                            <input type="text" name="nom_brochure" id="nom_brochure" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="inputPassword4">Fichier du brochure</label>
                            <input type="file" class="form-control" id="fichier" name="fichier" accept="image/*,application/pdf" required>

                        </div>

                    <button type="button" class="btn btn-primary m-1 modification-btn" data-id_info_type_stand="{{$id_info_type_stand}}">
                        Modifier
                    </button>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->




<!-- Include jQuery if not already included -->
<script src="{{asset('assets/js/jquery.js')}}"></script>
<!-- Include SweetAlert -->
<script src="{{asset('assets/js/sweatalert.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.modification-btn').on('click', function(e) {
            e.preventDefault();

            let id_info_type_stand = $(this).data('id_info_type_stand');
            let nom_brochure = $('#nom_brochure').val();
            let fichier = $('#fichier')[0].files[0]; // Get the selected file object

            console.log(nom_brochure,fichier);


            if (id_info_type_stand != null)
            {

                    Swal.fire({
                    title: "Êtes-vous sûr?",
                    text: "Voulez-vous vraiment modifier ce brochure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, modifier',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = new FormData();
                        formData.append('id_info_type_stand', id_info_type_stand);
                        formData.append('nom_brochure', nom_brochure);
                        formData.append('fichier', fichier);
                        formData.append('_token', '{{ csrf_token() }}');
                        $.ajax({
                            url: "{{route('modificationBrochure')}}",
                            method: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: "Succès",
                                    text: "Brochure modifié.",
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    //location.reload(); // Refresh the page to update the list
                                    window.location.href = "{{ route('viewChoixDeStandBrochure') }}";
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: "Erreur",
                                    text: "Une erreur est survenue. Veuillez réessayer.",
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });

            }
        });
    });
</script>


@endsection --}}

@extends('parent.parentDirecteurEmp')
@section('formulaireDeModificationBrochureSection')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">Formulaire de modification de brochure</strong>
            </div>
            <div class="card-body">
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

                <form id="modificationBrochureForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="nom_brochure">Nom brochure</label>
                            <input type="text" name="nom_brochure" id="nom_brochure" class="form-control">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="fichier">Fichier du brochure</label>
                            <input type="file" class="form-control" id="fichier" name="fichier" accept="image/*,application/pdf" required>
                        </div>

                        <button type="button" class="btn btn-primary m-1 modification-btn" data-id_info_type_stand="{{ $id_info_type_stand }}">
                            Modifier
                        </button>
                    </div>
                </form>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->

<!-- Include jQuery if not already included -->
<script src="{{asset('assets/js/jquery.js')}}"></script>
<!-- Include SweetAlert -->
<script src="{{asset('assets/js/sweatalert.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.modification-btn').on('click', function(e) {
            e.preventDefault();

            let id_info_type_stand = $(this).data('id_info_type_stand');
            let nom_brochure = $('#nom_brochure').val();
            let fichier = $('#fichier')[0].files[0];

            if (id_info_type_stand != null) {
                Swal.fire({
                    title: "Êtes-vous sûr?",
                    text: "Voulez-vous vraiment modifier cette brochure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, modifier',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Utiliser FormData pour gérer le fichier
                        let formData = new FormData();
                        formData.append('id_info_type_stand', id_info_type_stand);
                        formData.append('nom_brochure', nom_brochure);
                        formData.append('fichier', fichier);
                        formData.append('_token', '{{ csrf_token() }}');

                        $.ajax({
                            url: "{{route('modificationBrochure')}}",
                            method: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: "Succès",
                                    text: "Brochure modifiée.",
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = "{{ route('viewChoixDeStandBrochure') }}";
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: "Erreur",
                                    text: "Une erreur est survenue. Veuillez réessayer.",
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            }
        });
    });
</script>

@endsection

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

                        <input type="hidden" name="id_brochure_stand" value="{{$id_brochure_stand}}">

                        <button type="button" class="btn btn-primary m-1 modification-btn" data-id_info_type_stand="{{ $id_info_type_stand }}">
                            Modifier
                        </button>
                    </div>
                </form>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->


<!-- Modal Bootstrap -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmer le licenciement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle flex-shrink-0 me-2 text-warning" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                </svg>
                <div>
                    Êtes-vous sûr de vouloir modifier votre brochure.La brochure va encore etre valider par
                    l'organisateur
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmerModifBtn">Modifier</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-check-circle text-success animate__animated animate__zoomIn" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                </svg>
                <h5 class="mt-3">Succès !</h5>
                <p>Brochure en cours de validation.</p>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- Include jQuery if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        let nomBrochure;
        let fichier;
        let idBrochureStand;

        $('.modification-btn').on('click', function(e) {
            e.preventDefault();
            // selectedEmpId = $(this).data('id');
            // const empName = $(this).data('name');

            // $('#empName').text(empName);

            nomBrochure = $('#nom_brochure').val();
            fichier = $('#fichier')[0].files[0]; // fichier = objet File
            idBrochureStand = $('input[name="id_brochure_stand"]').val();



            $('#confirmModal').modal('show');
        });

        $('#confirmerModifBtn').on('click', function() {
            // id_emp: selectedEmpId,
                    const formData = new FormData();
                    formData.append('nom_brochure', nomBrochure);
                    formData.append('fichier', fichier);
                    formData.append('id_brochure_stand', idBrochureStand);
                     formData.append('id_info_type_stand', $('.modification-btn').data('id_info_type_stand'));
                    formData.append('_token', '{{ csrf_token() }}');


            $.ajax({
                url: "{{route('modificationBrochure')}}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#confirmModal').modal('hide');
                    $('#successModal').modal('show');
                    setTimeout(() => location.reload(), 2000);
                },
                error: function(xhr) {
                    $('#confirmModal').modal('hide');
                    const errorAlert = `
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle flex-shrink-0 me-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                            </svg>
                            <div>
                                Une erreur est survenue. Veuillez réessayer.
                            </div>
                        </div>`;
                    $(".col-10").prepend(errorAlert);
                }
            });
        });
    });
</script>
{{--
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
</script> --}}

@endsection

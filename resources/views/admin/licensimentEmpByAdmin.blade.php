
@extends('parent.ParentAdmin')
@section('licensimentEmpByAdminSection')

<h1>Choisissez le directeur ou l'employé que vous souhaitez licencier</h1>

<div class="col-10">

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

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom et prénom</th>
                <th>Poste</th>
                <th>Stand</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- Liste des Directeurs --}}
            @foreach ($directeur as $list_des_directeurs)
                <tr>
                    <td>{{ $list_des_directeurs->nom_directeur }} {{ $list_des_directeurs->prenom_directeur }}</td>
                    <td>Responsable</td>
                    <td>{{$list_des_directeurs->nom_stand}}</td>
                    <td>
                        <form action="{{route('viewPromouvoirEmpEnDirecteur')}}" method="GET">
                            <input type="hidden" name="id_directeur" value="{{ $list_des_directeurs->id_directeur }}">
                            <input type="hidden" name="id_stand" value="{{$list_des_directeurs->id_stand}}">
                            <input type="hidden" name="id_membre_stand" value="{{$list_des_directeurs->id_membre_stand}}">
                            <input type="submit" class="btn btn-danger m-1" value="Licensier">
                        </form>
                    </td>
                </tr>
            @endforeach

            {{-- Liste des Employés --}}
            @foreach ($employer as $list_des_employes)
                <tr>
                    <td>{{ $list_des_employes->nom_emp }} {{ $list_des_employes->prenom_emp }}</td>
                    <td>Editeur</td>
                    <td>{{$list_des_employes->nom_stand}}</td>
                    <td>
                        {{-- <button class="btn btn-danger m-1 licensier-btn" data-id_emp="{{ $list_des_employes->id_emp }}">
                            Licencier
                        </button> --}}
                        <button class="btn btn-danger m-1 licensier-btn">
                            Licencier
                        </button>
                        <input type="hidden" name="id_emp" id="id_emp" value="{{ $list_des_employes->id_emp }}">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>




<!-- Modal Bootstrap -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmer Votre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle flex-shrink-0 me-2 text-warning" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                </svg>
                <div>
                    Êtes-vous sûr de vouloir licensier cet editeur.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmLicensierBtn">Oui je suis sur</button>
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
                <p>L'employé a été licencié avec succès.</p>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


<!-- Include jQuery if not already included -->
<script src="assets/js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function(){
        let id_emp;
        $('.licensier-btn').on('click',function(e){
            e.preventDefault();
            id_emp = $('#id_emp').val();
            console.log(id_emp);
            $('#confirmModal').modal('show');
        });

        $('#confirmLicensierBtn').on('click', function() {
            $.ajax({
                url: "{{route('licensimentEmployerByAdmin')}}",
                method: 'POST',
                data: {
                    id_emp: id_emp,
                    _token: '{{ csrf_token() }}'
                },
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
{{-- <script>
    $(document).ready(function() {
        $('.licensier-btn').on('click', function(e) {
            e.preventDefault();
            let empId;
            empId =  $('#id_emp').val();;

            console.log(empId);

            // if (empId != null)
            // {

            //         Swal.fire({
            //         title: "Êtes-vous sûr?",
            //         text: "Voulez-vous vraiment licencier cet employé?",
            //         icon: "warning",
            //         showCancelButton: true,
            //         confirmButtonColor: '#d33',
            //         cancelButtonColor: '#3085d6',
            //         confirmButtonText: 'Oui, licencier',
            //         cancelButtonText: 'Annuler'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             $.ajax({
            //                 url: "{{route('licensimentEmployerByAdmin')}}",
            //                 method: 'POST',
            //                 data: {
            //                     id_emp: empId,
            //                     _token: '{{ csrf_token() }}'
            //                 },
            //                 success: function(response) {
            //                     Swal.fire({
            //                         icon: 'success',
            //                         title: "Succès",
            //                         text: "L'employé a été licencié avec succès.",
            //                         confirmButtonColor: '#3085d6',
            //                         confirmButtonText: 'OK'
            //                     }).then(() => {
            //                         //location.reload(); // Refresh the page to update the list
            //                         window.location.href = "{{ route('viewLicensimentEmpByAdmin') }}";
            //                     });
            //                 },
            //                 error: function(xhr) {
            //                     Swal.fire({
            //                         icon: 'error',
            //                         title: "Erreur",
            //                         text: "Une erreur est survenue. Veuillez réessayer.",
            //                         confirmButtonColor: '#3085d6',
            //                         confirmButtonText: 'OK'
            //                     });
            //                 }
            //             });
            //         }
            //     });

            // }
        });
    });
</script> --}}

@endsection

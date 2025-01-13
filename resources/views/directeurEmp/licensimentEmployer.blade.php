@extends('parent.parentDirecteurEmp')
@section('licensimentEmployerSection')

<h1>Choisissez votre employer que vous souhaiter licensier</h1>

<div class="col-10">

    @if (session('success'))
    <div class="alert alert-success d-flex align-items-center animate__animated animate__fadeInDown" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle flex-shrink-0 me-2" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
        </svg>
        <div>
            {!! session('success') !!}
        </div>
    </div>
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nom de stand</th>
                <th>Description</th>
                <th>Nom et prenom</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employerDirecteur as $list_employerDirecteur)
                <tr>
                    <td>
                        <h6>{{$list_employerDirecteur->nom_stand}}</h6>
                    </td>
                    <td>{{$list_employerDirecteur->description_stand}}</td>
                    <td>{{$list_employerDirecteur->nom_emp}}  {{$list_employerDirecteur->prenom_emp}}</td>
                    <td>
                        <button class="btn btn-danger m-1 licensier-btn" data-id="{{ $list_employerDirecteur->id_emp }}" data-name="{{ $list_employerDirecteur->nom_emp }} {{ $list_employerDirecteur->prenom_emp }}">
                            Licensier
                        </button>
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
                <h5 class="modal-title" id="confirmModalLabel">Confirmer le licenciement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle flex-shrink-0 me-2 text-warning" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                </svg>
                <div>
                    Êtes-vous sûr de vouloir licencier <span id="empName"></span> ?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmLicensierBtn">Licensier</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        let selectedEmpId;

        $('.licensier-btn').on('click', function(e) {
            e.preventDefault();
            selectedEmpId = $(this).data('id');
            const empName = $(this).data('name');

            $('#empName').text(empName);
            $('#confirmModal').modal('show');
        });

        $('#confirmLicensierBtn').on('click', function() {
            $.ajax({
                url: "{{route('licensiment')}}",
                method: 'POST',
                data: {
                    id_emp: selectedEmpId,
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

@endsection

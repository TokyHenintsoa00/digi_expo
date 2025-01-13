@extends('parent.parentHome')

@section('homeReceptionSection')
    <div class="reception-details">
        <div class="salles-reception">
            <h3>Salon de : @foreach ($reception as $salle)
               {{ $salle->nom_du_sallon }}
            @endforeach</h3>
        </div>
        @foreach ($organisateur as $organisateur)
            <div class="organisateur-info">
                <h3>Organisateur : {{ $organisateur->nom_organisateur }}</h3>
                @foreach ($contact_organisateur as $contact)
                    @if ($contact->id_organisateur === $organisateur->id_organisateur)
                        <p>{{ $contact->type_contact }} - {{ $contact->contact }}</p>
                    @endif
                @endforeach
            </div>
        @endforeach


    </div>
@endsection

@extends('parent.parentDirecteurEmp')
@section('justificationDemissionEditeurSection')

<h1 style="font-size: 2em; font-weight: bold; color: #2c3e50; text-align: center; margin-bottom: 20px;">Justification</h1>

@foreach ($justification as $justification_editeur)
    <div style="background-color: #f4f6f9; padding: 15px; border-radius: 8px; margin-bottom: 10px; border: 1px solid #ddd;">
        <p style="font-size: 1.1em; color: #34495e;">{{$justification_editeur->justification_demission }}</p>
    </div>
@endforeach

@endsection

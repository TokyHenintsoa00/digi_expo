<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    public function index()
    {
        $getEventModel = new Event();
        $id_emp = Session::get('id_emp');
        $eventData = $getEventModel->getAll($id_emp); // Récupère tous les événements
       dd($eventData);
    }


    //
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date', // Start est un datetime généré automatiquement côté client
            'end' => 'required|date|after_or_equal:start', // Vérifie que la date de fin >= début
            'importance' => 'required|string',
            'color' => 'required|string',

        ]);

        $start = $request->start
        ? Carbon::parse($request->start)->setTimezone('Indian/Antananarivo')->setTime(now()->hour, now()->minute, now()->second)
        : Carbon::now('Indian/Antananarivo');

        $end = Carbon::parse($request->end)->setTimezone('Indian/Antananarivo');

        $id_emp = Session::get('id_emp');

        $event = Event::create([
            'title' => $request->title,
            'start' => $start->toDateTimeString(), // Format pour la base de données
            'end' => $end->toDateTimeString(),
            'importance' => $request->importance,
            'color' => $request->color,
            'id_emp' =>$id_emp,
        ]);

        // dd($id_emp);

        return response()->json($event, 201);
    }

    

    public function delete(Request $request)
    {
        $event = Event::find($request->id);
        if ($event) {
            $event->delete();
            return response()->json(['message' => 'Événement supprimé'], 200);
        }

        return response()->json(['message' => 'Événement non trouvé'], 404);
    }


    public function update(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:events,id',
        'start' => 'required|date',
        'end' => 'required|date|after_or_equal:start',
    ]);

    $event = Event::find($request->id);
    if ($event) {
        $event->start = Carbon::parse($request->start)->setTimezone('Indian/Antananarivo');
        $event->end = Carbon::parse($request->end)->setTimezone('Indian/Antananarivo');
        $event->save();

        return response()->json(['message' => 'Événement mis à jour avec succès'], 200);
    }

    return response()->json(['message' => 'Événement non trouvé'], 404);
}



}

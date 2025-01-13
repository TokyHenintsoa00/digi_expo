<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);


            // Exécution de la requête d'insertion avec DB::insert
            DB::insert('
                INSERT INTO locations (name, coordinates)
                VALUES (?, ST_SetSRID(ST_MakePoint(?, ?), 4326))',
                [
                    $validated['name'],   // Nom du lieu
                    $validated['longitude'], // Longitude
                    $validated['latitude'],  // Latitude
                ]
            );

            return redirect()->route('viewEmpPage');

    }

    public function map()
    {
        $locations = Location::all()->map(function ($location) {
            $coords = DB::selectOne("SELECT ST_X(coordinates) AS longitude, ST_Y(coordinates) AS latitude FROM locations WHERE id = ?", [$location->id]);
            return [
                'name' => $location->name,
                'latitude' => $coords->latitude,
                'longitude' => $coords->longitude,
            ];
        });

        return view('home.homePage', ['locations' => $locations]);
    }


}

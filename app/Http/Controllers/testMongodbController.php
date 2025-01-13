<?php

namespace App\Http\Controllers;

use App\Models\Mongodb;
use Illuminate\Http\Request;

class TestMongodbController extends Controller
{
    public function insertData()
    {
        $model = new Mongodb();

        $data = [
            ['title' => 'Hello MongoDB', 'content' => 'This is a test message inserted into MongoDB.'],
            ['title' => 'Another Message', 'content' => 'This is another test message inserted into MongoDB.']
        ];

        $result = $model->insert($data);

        if ($result->isAcknowledged()) {
            return response()->json(['message' => 'Messages ajoutés avec succès']);
        } else {
            return response()->json(['error' => 'Erreur lors de l\'ajout des messages'], 500);
        }
    }

    // public function getMessages()
    // {
    //     $model = new Mongodb();
    //     $messages = $model->getAll();

    //     return response()->json($messages);
    // }

    public function getMessages(Request $request)
    {
        $model = new Mongodb();

        // Exemple : Filtrer les messages par titre
        $filter = [];
        if ($request->has('title')) {
            $filter = ['title' => $request->input('title')];
        }

        $messages = $model->getAll($filter);

        return response()->json($messages);
    }

    // /mongodb/messages?title=Hello MongoDB


}

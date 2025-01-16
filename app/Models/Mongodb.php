<?php

namespace App\Models;

use MongoDB\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class Mongodb
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'created_at'
    ];

    private $collection;

    public function __construct()
    {
        $client = new Client(env('MONGO_DB_URI'));
        $database = $client->selectDatabase(env('MONGO_DB_DATABASE'));
        $this->collection = $database->selectCollection('message');
        
    }

    public function insert(array $data)
    {
        return $this->collection->insertMany($data);
    }

    // public function getAll()
    // {
    //     return $this->collection->find()->toArray();
    // }

    public function getAll(array $filter = [])
    {
        return $this->collection->find($filter)->toArray();
    }


    public function fetchMessagesV1($sender_id, $receiver_id)
    {
        // Récupérer les messages entre deux utilisateurs
        $filter = [
            '$or' => [
                [
                    'sender_id' => $sender_id,
                    'receiver_id' => $receiver_id
                ],
                [
                    'sender_id' => $receiver_id,
                    'receiver_id' => $sender_id
                ]
            ]
        ];

        // Obtenir les messages avec le filtre
        $messages = $this->getAll($filter);

        // Assurer que les messages sont triés par date de création (croissant)
        usort($messages, function($a, $b) {
            return strtotime($a['created_at']) - strtotime($b['created_at']);
        });

        // Mapper les messages pour les afficher correctement dans la vue
        $formattedMessages = array_map(function ($message) use ($sender_id) {
            return [
                'content' => $message['content'],
                'sender_id' => $message['sender_id'],
                'is_sent' => $message['sender_id'] === $sender_id // True si c'est un message envoyé
            ];
        }, $messages);

        // Retourner les messages formatés sous forme JSON
        return response()->json($formattedMessages);
    }

}

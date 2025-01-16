<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Mongodb;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    //
    public function sendMessage(Request $request)
    {
        $message = new Message();
        $id_expediteur = $request->receiver_id;
        $message->sender_id = $request->sender_id;
        $message->receiver_id = $request->receiver_id;
        $message->content = $request->content;
        $message->save();
        return response()->json(['success' => true, 'message' => 'Message envoyé.']);
    }

    public function fetchMessages($sender_id, $receiver_id)
    {
        $messages = Message::where(function($query) use ($sender_id, $receiver_id) {
            $query->where('sender_id', $sender_id)
                  ->where('receiver_id', $receiver_id);
        })->orWhere(function($query) use ($sender_id, $receiver_id) {
            $query->where('sender_id', $receiver_id)
                  ->where('receiver_id', $sender_id);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json($messages);
    }


    public function sendMessageV1(Request $request)
    {
       $message = new Mongodb();


        // Récupérer les données du request
        $senderId = $request->input('sender_id');      // ID de l'expéditeur
        $receiverId = $request->input('receiver_id');  // ID du destinataire
        $content = $request->input('content');         // Contenu du message

        // Définir les champs dans le modèle
        $message->sender_id = $senderId;
        $message->receiver_id = $receiverId;
        $message->content = $content;

        // Définir la date-heure actuelle au format ISO 8601
        $createdAt = Carbon::now()->toDateTimeString();

        // Créer un tableau de données à insérer
        $data = [
            [
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'content' => $content,
                'created_at' =>$createdAt
            ]
        ];


        //mi set collection rehefa eto 

        // Sauvegarder les données dans MongoDB
        $insertResult = $message->insert($data);

        // Vérifier si l'insertion a réussi
        if ($insertResult) {
            return response()->json(['message' => 'Message envoyé avec succès']);
        } else {
            return response()->json(['error' => 'Erreur lors de l\'envoi du message'], 500);
        }
    }

    public function fetchMessagesV1($sender_id, $receiver_id)
    {
        $mongodb = new Mongodb();
        return $mongodb->fetchMessagesV1($sender_id, $receiver_id);
    }




}

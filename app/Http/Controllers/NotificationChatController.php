<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationMessage;
use App\Models\Notification;
class NotificationChatController extends Controller
{
    public function markAsRead($id)
    {
        $notification = NotificationMessage::findOrFail($id);
        $notification->update(['is_read' => true]);

        // Rediriger vers le lien de la notification
        return redirect($notification->link);
    }


    public function createNotificationMessageDirecteurToEmp(Request $request)
    {
        $id_receiver = $request->receiver_id;
        $id_sender = $request->sender_id;
        $nom_directeur = $request->nom_directeur;
        $prenom_directeur = $request->prenom_directeur;
        $id_directeur = $request->id_directeur;
        $etat_directeur = $request->etat_directeur;
        // $link = "/employer/viewMessageSendOrReciveEmp?nom={$nom_directeur}&prenom={$prenom_directeur}&id={$id_directeur}&etat={$etat_directeur}";
          // Générer le lien en utilisant le nom de la route
        $link = route('chat.employeeToEmploye', [
            'nom' => $nom_directeur,
            'prenom' => $prenom_directeur,
            'id' =>$id_directeur,
            'etat' =>$etat_directeur
        ]);
        Notification::create([
            'user_id' => 0,
            'receiver_id' => $id_receiver,
            'sender_id' => $id_sender,
            'title' => 'Message',
            'message' => 'Vous avez recu un nouveaux message 90',
            'link' =>$link
        ]);
    }

    public function createNotificationMessageEmpToEmp(Request $request)
    {
        $id_receiver = $request->receiver_id;
        $id_sender = $request->sender_id;
        $nom_emp = $request->nom_emp;
        $prenom_emp = $request->prenom_emp;
        $id_emp = $request->id_emp;
        $etat_personne = $request->etat_personne;
        // $link = route('viewMessageSendOrReciveEmp',compact('id_receiver','id_sender'));
        $link = route('chat.employeeToEmploye',[
            'nom' =>$nom_emp,
            'prenom' =>$prenom_emp,
            'id' => $id_emp,
            'etat' =>$etat_personne
        ]);
        Notification::create([
            'user_id' =>0,
            'receiver_id' => $id_receiver,
            'sender_id' => $id_sender,
            'title' => 'Message',
            'message' => 'Vous avez recu un nouveaux message',
            'link' =>$link
        ]);
    }

    public function createNotificationMessageEmpToDirecteur(Request $request)
    {
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;
        $nom_emp = $request->nom_emp;
        $prenom_emp = $request->prenom_emp;
        $id_emp = $request->id_emp;
        $id_directeur = $request->id_directeur;
        $nom_directeur = $request->nom_directeur;
        $prenom_directeur = $request->prenom_directeur;
        $etat_directeur = $request->etat_directeur;
        $link = route('chat.employeeToDirector',[
            'nom_emp' =>$nom_emp,
            'prenom_emp' =>$prenom_emp,
            'id_emp' =>$id_emp,
            'id_directeur' =>$id_directeur,
            'nom_directeur' =>$nom_directeur,
            'prenom_directeur' =>$prenom_directeur,
            'etat_directeur' =>$etat_directeur
        ]);
        Notification::create([
            'user_id' =>0,
            'receiver_id' => $receiver_id,
            'sender_id' => $sender_id,
            'title' => 'Message',
            'message' => 'Vous avez recu un nouveaux message 80',
            'link' =>$link
        ]);
    }


    public function viewChatDirToEmp($nom,$prenom,$id,$etat)
    {
        return null;
    }

    public function viewChatEmpToDIr($nom_emp,$prenom_emp,$id_emp,$id_directeur,$nom_directeur,$etat_directeur)
    {
        return null;
    }

    public function viewChatEmpToEmp($nom,$prenom,$id,$etat)
    {
        return null;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Events\NotificationSent;
class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);

        // Rediriger vers le lien de la notification
        return redirect($notification->link);
    }


    // public function createNotificationMessageDirecteurToEmp(Request $request)
    // {
    //     $id_receiver = $request->receiver_id;

    //     Notification::create([
    //         'user_id' => $id_receiver,
    //         'title' => 'Message',
    //         'message' => 'Vous avez recu un nouveaux message',
    //         'link' =>route('viewMessageSendOrReciveEmp')
    //     ]);
    // }

    // public function createNotificationMessageEmpToEmp(Request $request)
    // {
    //     $id_receiver = $request->receiver_id;

    //     Notification::create([
    //         'user_id' => $id_receiver,
    //         'title' => 'Message',
    //         'message' => 'Vous avez recu un nouveaux message',
    //         'link' =>route('viewMessageSendOrReciveEmp')
    //     ]);
    // }

    // public function createNotificationMessageEmpToDirecteur(Request $request)
    // {
    //     $id_receiver = $request->receiver_id;

    //     Notification::create([
    //         'user_id' => $id_receiver,
    //         'title' => 'Message',
    //         'message' => 'Vous avez recu un nouveaux message',
    //         'link' =>route('viewMessageSendOrReciveDirecteur')
    //     ]);
    // }


    // public function getMessage($sender_id,$receiver_id)
    // {
    //     $id_personne = Session::get('id_emp');

    //     // $result = DB::select("  ")
    // }



}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notification_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receiver_id');  // ID de l'utilisateur qui reçoit la notification
            $table->unsignedBigInteger('sender_id');  // ID de l'utilisateur qui envoie la notification
            $table->string('title');
            $table->string('message');              // Message de la notification
            $table->string('link')->nullable();     // Lien de redirection
            $table->boolean('is_read')->default(false);  // Statut de la notification (lu/non-lu)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_messages');
    }
};

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    //
    public function resetPasswordAdmin()
    {
        return view('emails.reset');
    }
}

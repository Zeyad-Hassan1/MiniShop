<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmationController extends Controller
{
    public function showConfirmation()
    {
        if (!Auth::check()) {
            session(['url.intended' => route('checkout.confirmation')]);
            return redirect()->route('login.form')->with('message', 'Please login to complete the purchase.');
        }

        return view('checkout.confirmation');
    }
}

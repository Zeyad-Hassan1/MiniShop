<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('product')->latest()->get();

        return view('order-history', compact('orders'));
    }
}

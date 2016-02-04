<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (\Auth::check()) {
            return redirect()->route('notes.app');
        }

        return view('notes.index');
    }
}

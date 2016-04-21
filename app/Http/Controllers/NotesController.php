<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Notes\NotesRepository;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(NotesRepository $notes)
    {
        return view('notes.app', ['notes' => $notes->getNotesOfUser(\Auth::user())]);
    }
}

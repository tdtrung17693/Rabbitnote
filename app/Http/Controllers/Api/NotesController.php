<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\NoteRequest;
use App\Notes\Note;
use App\Notes\NotesRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function __construct(NotesRepository $notes, Guard $guard)
    {
        $this->notes = $notes;
        $this->user = $guard->user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->notes->getNotesOfUser($this->user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        $noteData = $request->all();

        $note = new Note();

        $note->title = $noteData['title'];
        $note->content = $noteData['content'];

        return response()->json($this->notes->saveNoteOfUser($note, $this->user));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->notes->getNoteOfUserById($id, $this->user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $note = $this->getNoteOfUser($id, $this->user);

            return response(['deleted' => $this->notes->trashNote($note)]);
        } catch (ModelNotFoundException $e) {
            return abort(400, 'Cannot delete this note');
        } catch (HttpException $e) {
            return abort(403, 'Not authorized to perform this action');
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\NoteRequest;
use App\Notes\Note;
use App\Notes\NotesRepository;
use Dingo\Api\Routing\Helpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Notes\NoteTransformer;

class NotesController extends Controller
{
    use Helpers;

    public function __construct(NotesRepository $notes, Guard $guard)
    {
        $this->middleware('api.auth');
        // $this->middleware('jwt.refresh');

        $this->notes = $notes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        if ((int) $userId !== $this->user->id) {
            return $this->response->errorForbidden();
        }

        $notes = $this->notes->getNotesOfUser($this->user);

        return $this->response->collection($notes, NoteTransformer::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request, $userId)
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $note = $this->notes->getNoteOfUserById($id, $this->user);

            if ( !$this->user->can('change', $note) ) {
                return abort(403, 'Not authorized to perform this action');
            }

            $note->title = $request->get('title');
            $note->content = $request->get('content');

            if ( !$note->save() ) {
                return response()->json(['success' => false, 'message' => 'Cannot save this note.']);
            }

            return $this->response->item($note, new NoteTransformer);
        } catch (ModelNotFoundException $e) {
            return abort(400, 'Cannot delete this note');
        } catch (HttpException $e) {
            return abort(403, 'Not authorized to perform this action');
        }
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
            $note = $this->notes->getNoteOfUserById($id, $this->user);

            return response(['deleted' => $this->notes->trashNote($note)]);
        } catch (ModelNotFoundException $e) {
            return abort(400, 'Cannot delete this note');
        } catch (HttpException $e) {
            return abort(403, 'Not authorized to perform this action');
        }
    }
}

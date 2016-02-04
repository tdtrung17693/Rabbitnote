<?php
namespace App\Notes;

use App\User;

class NotesRepository
{
    public function getDeleted()
    {
        return Note::onlyTrashed()->get();
    }

    public function getNotesOfUser(User $user)
    {
        return $user->notes()->latest()->get();
    }

    public function getNoteOfUserById($id, User $user)
    {
        return $user->notes()->findOrFail($id);
    }

    public function saveNoteOfUser(Note $note, User $user)
    {
        return $user->notes()->save($note);
    }

    public function trashNoteOfUserById($id, User $user)
    {
        $note = $user->notes()->findOrFail($id);
        return $note->delete();
    }
}

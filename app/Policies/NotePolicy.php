<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function change(User $user, Note $note)
    {
        return $user->id === $note->user_id;
    }
}

<?php

use App\Notes\Note;
use App\Notes\NotesRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Getting Started');
    }

    public function testNoteThrowException()
    {
        $this->setExpectedException(ModelNotFoundException::class);
        $user = \App\User::find(21);
        $repo = new NotesRepository;

        $repo->getNoteOfUserById(null, $user);
    }
}

<?php

use Illuminate\Database\Seeder;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Notes\Note::class, 40)->make()->each(function ($note) {
            $user = \App\User::find(mt_rand(1, 20));

            $user->notes()->save($note);
        });
    }
}

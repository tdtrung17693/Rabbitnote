<?php
namespace App\Notes;

use App\Notes\Note;
use League\Fractal\TransformerAbstract;

class NoteTransformer extends TransformerAbstract
{
	public function transform(Note $note)
	{
		return [
			'id' => $note->id,
			'title' => $note->title,
			'content' => $note->content,
			'created_at' => $note->created_at->format('M d, Y')
		];
	}
}
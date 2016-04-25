<?php
namespace App;

use App\Notes\NoteTransformer;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	protected $availableIncludes = [
		'notes'
	];
	
	public function transform(User $user)
	{
		return [
			'id' => (int) $user->id,
			'name' => $user->name,
			'email' => $user->email
		];
	}

	public function includeNotes(User $user)
	{
		$notes = $user->notes;
		
		return $this->collection($notes, new NoteTransformer);
	}
} 
<?php
namespace App\Notes;

use App\Notes\Note;
use App\Tags\TagTransformer;
use League\Fractal\TransformerAbstract;

class NoteTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'tags'
    ];

	public function transform(Note $note)
	{
		return [
			'id' => $note->id,
			'title' => $note->title,
			'content' => $note->content,
			'created_at' => $note->created_at->format('M d, Y')
		];
	}

    public function includeTags(Note $note)
    {
        $tags = $note->tags;

        return $this->collection($tags, new TagTransformer);
    }
}
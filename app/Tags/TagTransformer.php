<?php
namespace App\Tags;

use App\Notes\NoteTransformer;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    public function transform(Tag $tag)
    {
        return [
            'id' => (int) $tag->id,
            'slug' => $tag->slug,
            'data' => $tag->data
        ];
    }

    public function includeNotes(User $user)
    {
        $notes = $user->notes()->latest()->get();

        return $this->collection($notes, new NoteTransformer);
    }
}

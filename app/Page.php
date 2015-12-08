<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'slug', 'title', 'content', 'is_published', 'user_id'
    ];

    /**
     * A page is owned by a user.
     *
     * Makes it possible to find a user by page:
     * $page = App\Page::findOrFail($id);
     * $page->user()->get()->toArray();
     * **OR** $page->user->toArray();
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

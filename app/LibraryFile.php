<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibraryFile extends Model
{
    protected $table = 'assets';

    protected $appends = [
        'isRoot'
    ];

    protected $casts = [
        'is_deletable' => 'boolean',
        'type_id' => 'integer',
        'is_batch' => 'boolean'
    ];

    /**
     * @return bool
     */
    public function getIsRootAttribute()
    {
        return $this->parent_id === null;
    }

    /**
     * @return bool
     */
    public function getHasChildrenAttribute()
    {
        // need to change this so it doesn't autoload the children relation
        return $this->children->count() > 0;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(LibraryFile::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->hasMany(self::class, 'parent_id')->orderBy('type_id');
    }

}

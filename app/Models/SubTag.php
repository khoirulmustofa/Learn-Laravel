<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTag extends Model
{
    use HasFactory;

    protected $table = 'sub_tags';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    /**
     * Define the relationship between the given tag and
     * all the posts it was associated to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }
}

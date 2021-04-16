<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    public $primaryKey = 'id';
    public $timestramps = true;

    protected $fillable = [
        'title',
        'category_id',
        'description',
        'cover_image',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * Get the index name for the model.
     * 
     * @return string
     */
    public function searchableAs() {
        return 'posts_index';
    }
}

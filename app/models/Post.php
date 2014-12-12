<?php
use Illuminate\Database\Eloquent\Model;

/**
 * Short description for the file.
 *
 * @author      Jaap Faes <jaap@komma.pro>
 * @copyright   (c) 2012-2014, Komma Mediadesign
 */

class Post extends Model {

    protected $fillable = ['body'];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function clique(){
        return $this->belongsTo('Clique');
    }

    public function comments()
    {
        return $this->morphMany('Comment', 'commentable');
    }

}
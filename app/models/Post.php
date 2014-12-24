<?php
use Illuminate\Database\Eloquent\Model;

/**
 * Short description for the file.
 *
 * @author      Jaap Faes <jaap@komma.pro>
 * @copyright   (c) 2012-2014, Komma Mediadesign
 */

class Post extends Magniloquent {

    protected $fillable = ['body'];

    public static $rules = [
        'save' => [
            'body' => 'required',
            'user_id' => 'required|numeric',
        ],
        'create' => [],
        'update' => [],
    ];

    public static $factory = [
        'body' => 'text',
        'user_id' => 'factory|User',
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function comments()
    {
        return $this->morphMany('Comment', 'commentable');
    }

}
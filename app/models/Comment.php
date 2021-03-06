<?php
use Illuminate\Database\Eloquent\Model;

/**
 * Short description for the file.
 *
 * @author      Jaap Faes <jaap@komma.pro>
 * @copyright   (c) 2012-2014, Komma Mediadesign
 */

class Comment extends Model{

    protected $fillable = ['body'];

    public static $rules = [
        'body' => 'required',
    ];

    public static $factory = [
        'body' => 'text',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

}
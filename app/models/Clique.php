<?php
use Illuminate\Database\Eloquent\Model;

/**
 * Short description for the file.
 *
 * @author      Jaap Faes <jaap@komma.pro>
 * @copyright   (c) 2012-2014, Komma Mediadesign
 */

class Clique extends Model{

    public function users()
    {
        return $this->belongsToMany('User');
    }

    public function posts()
    {
        return $this->hasMany('Post');
    }

}
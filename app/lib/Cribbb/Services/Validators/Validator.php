<?php
/**
 * Short description for the file.
 *
 * @author      Jaap Faes <jaap@komma.pro>
 * @copyright   (c) 2012-2014, Komma Mediadesign
 */

namespace Cribbb\Services\Validators;

abstract class Validator {

    protected $input;
    protected $errors;

    public function __construct($input = null)
    {
        $this->input = $input ?: \Input::all();
    }

    public function passes()
    {
        $validation = \Validator::make($this->input, static::$rules);
        if($validation->passes()) return true;
        $this->errors = $validation->messages();
        return false;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}
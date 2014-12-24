<?php
/**
 * Short description for the file.
 *
 * @author      Jaap Faes <jaap@komma.pro>
 * @copyright   (c) 2012-2014, Komma Mediadesign
 */

namespace Cribbb\Services\Validators;

class User extends Validator {

    public static $rules = [
        'username' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required|min:8'
    ];

}
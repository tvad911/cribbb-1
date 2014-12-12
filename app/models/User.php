<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends Ardent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $fillable = ['username', 'email'];

	public $autoPurgeRedundantAttributes = true;

	public static $rules = array(
		'username' => 'required|between:4,16',
		'email' => 'required|email',
		'password' => 'required|alpha_num|min:8|confirmed',
		'password_confirmation' => 'required|alpha_num|min:8',
	);

	public function posts()
	{
		return $this->hasMany('Post');
	}

}

<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends Magniloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';
	protected $hidden = array('password', 'remember_token');
	protected $fillable = ['username', 'first_name', 'last_name', 'email', 'password', 'password_confirmation'];

	public $autoPurgeRedundantAttributes = true;

	public static $rules = [
		"save" => [
			'username' => 'required',
			'email' => 'required|email',
			'password' => 'required|min:8',
		],
		"create" => [
			'username' => 'unique:users',
			'email' => 'unique:users',
			'password' => 'confirmed',
			'password_confirm' => 'min:8',
		],
		"update" => []
	];

	public static $facotry = [
		'username' => 'string',
		'email' => 'email',
		'password' => 'password',
		'password_confirmation' => 'password',
	];

	public function posts()
	{
		return $this->hasMany('Post');
	}

	public function follow()
	{
		return $this->belongsToMany('User', 'user_follows', 'user_id', 'follow_id');
	}

	public function followers()
	{
		return $this->belongsToMany('User', 'user_follows', 'follow_id', 'user_id');
	}

}

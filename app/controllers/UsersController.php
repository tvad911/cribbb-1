<?php

use Cribbb\Storage\User\UserRepository;

class UsersController extends \BaseController {

	public function __construct(UserRepository $user)
	{
		$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->user->all();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$s = $this->user->create(Input::all());
		if($s->passes())
		{
			return Redirect::route('users.index')
				->with('flash', 'The new user has been created');
		}
		return Redirect::route('users.create')
			->withInput()
			->withErrors($s->errors());
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return $this->user->find($id);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('users.edit');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$s = $this->user->update($id);

		if($s->passes())
		{
			return Redirect::route('users.show', $id)
				->with('flash', 'The user was updated');
		}

		return Redirect::route('users.edit', $id)
			->withInput()
			->withErrors($s->errors());
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->user->delete($id);
	}


}

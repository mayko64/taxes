<?php namespace App\Http\Controllers;

use App\Http\Requests\TasksPostRequest;
class SmcsController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * Show the form to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('smcs/index');
	}
	
	/**
	 * List the tax tasks to the user
	 * 
	 * Ajax
	 * 
	 * @return Response
	 */
	public function tasks(TasksPostRequest $request)
	{
		die($request->get('current_year'));
	}

}

<?php namespace App\Http\Controllers;

use App\Http\Requests\TasksPostRequest;
use App\Task;
use App\TasksList;
use App\Report;

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
		return view('smcs/index', [
			'groups'         => Task::getGroups(),
			'periods'        => Task::getPeriods(),
			'esv_periods'    => Task::getESVPeriods(),
			'pay_strategies' => Task::getStrategies(),
			'types'          => Task::getTypes(),
			'locales'        => config('app.locales'),
		]);
	}

	/**
	 * List the tax tasks to the user
	 *
	 * @return Response
	 */
	public function tasks(TasksPostRequest $request)
	{
		App::setLocale($request->get('language'));
		
		$report = new Report();
		$report->setESVPeriod($request->get('esv_period'));
		$report->setGroup($request->get('group'));
		$report->setFrom($request->get('from'));
		$report->setTo($request->get('to'));
		
		$tasks = $report->getTasks();
		
		return view('smcs/tasks', ['tasks' => $tasks]);
	}

}

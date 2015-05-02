<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Tasks;
use App\Task;

class TasksPostRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$groups = array_keys(Task::getGroups());
		$esvPeriods = array_keys(Task::getESVPeriods());
		$supportedLanguages = config('app.locales');

		return [
			'group'        => 'required|in:' . join(',', $groups),
			'current_year' => 'required|date_format:Y',
			'esv_period'   => 'required|in:' . join(',', $esvPeriods),
			'from'         => 'required|date',
			'to'           => 'required|date',
			'language'     => 'required|in:' . join(',', $supportedLanguages),
		];
	}

}

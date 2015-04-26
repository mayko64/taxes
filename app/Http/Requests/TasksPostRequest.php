<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

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
		return [
			'group' => 'required|in:1,2,3,4,5,6',
			'current_year' => 'required|date_format:Y',
			'esv_period' => 'required|in:month,quater',
			'from' => 'required|date',
			'to' => 'required|date',
			'language' => 'required|in:ru,ua'
		];
	}

}

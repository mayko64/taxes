<?php namespace App\ShiftStrategies;

use App\Holiday;

abstract class ShiftStrategy {
	
	const NEXT_WORKING_DAY = 'next_working_day';
	const LAST_WORKING_DAY = 'last_working_day';
	
	abstract public function shift(\DateTime $date);
	
	public static function getStrategies() {
		return [
			self::NEXT_WORKING_DAY => trans('tasks.strategy.next_working_day'),
			self::LAST_WORKING_DAY => trans('tasks.strategy.last_working_day'),
		];
	}
	
	public static function isHoliday(\DateTime $date) {
		return (bool) Holiday::where('date', '=', $date->format('Y-m-d'))->first();
	}
	
	public static function isWeekend(\DateTime $date) {
		return in_array($date->format('N'), [6, 7]);
	}
}

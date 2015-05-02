<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

	const TYPE_EN = 'en';
	const TYPE_ND = 'nd';
	const TYPE_ESV = 'esv';
	
	const PERIOD_MONTH = 'month';
	const PERIOD_QUARTER = 'quarter';
	const PERIOD_YEAR = 'year';
	
	const GROUP_1 = 1;
	const GROUP_2 = 2;
	const GROUP_3 = 3;
	const GROUP_4 = 4;
	const GROUP_5 = 5;
	const GROUP_6 = 6;
	
	const STRATEGY_BEFORE_20 = 'before_20';
	const STRATEGY_EXTRA_20_DAYS = 'extra_20_days';
	const STRATEGY_EXTRA_40_DAYS = 'extra_40_days';
	const STRATEGY_EXTRA_50_DAYS = 'extra_50_days';
	
	protected $periodMap = [
		Task::PERIOD_MONTH   => 'P1M',
		Task::PERIOD_QUARTER => 'P3M',
		Task::PERIOD_YEAR    => 'P1Y',
	];
	
	public function getInterval() {
		return new \DateInterval($this->periodMap[$this->period]);
	}
	
	public static function getTypes() {
		return [
			self::TYPE_EN  => trans('tasks.type.en'),
			self::TYPE_ND  => trans('tasks.type.nd'),
			self::TYPE_ESV => trans('tasks.type.esv'),
		];
	}
	
	public static function getPeriods() {
		return [
			self::PERIOD_MONTH   => trans('tasks.period.month'),
			self::PERIOD_QUARTER => trans('tasks.period.quarter'),
			self::PERIOD_YEAR    => trans('tasks.period.year'),
		];
	}
	
	public static function getESVPeriods() {
		$periods = [
			self::PERIOD_MONTH,
			self::PERIOD_QUARTER,
		];
		
		return array_intersect_key(self::getPeriods(), array_flip($periods));
	}
	
	public static function getGroups() {
		return [
			self::GROUP_1 => trans('tasks.group') . ' 1',
			self::GROUP_2 => trans('tasks.group') . ' 2',
			self::GROUP_3 => trans('tasks.group') . ' 3',
			self::GROUP_4 => trans('tasks.group') . ' 4',
			self::GROUP_5 => trans('tasks.group') . ' 5',
			self::GROUP_6 => trans('tasks.group') . ' 6',
		];
	}

	public static function getStrategies() {
		return [
			self::STRATEGY_BEFORE_20     => trans('tasks.strategy.before_20'),
			self::STRATEGY_EXTRA_20_DAYS => trans('tasks.strategy.extra_20_days'),
			self::STRATEGY_EXTRA_40_DAYS => trans('tasks.strategy.extra_40_days'),
			self::STRATEGY_EXTRA_50_DAYS => trans('tasks.strategy.extra_50_days'),
		];
	}
}

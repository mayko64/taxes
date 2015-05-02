<?php namespace App\ShiftStrategies;

use App\Task;

class ShiftStrategiesFactory {
	
	/**
	 * @param string $strategy
	 * @throws \InvalidArgumentException
	 * @return \App\ShiftStrategies\ShiftStrategy
	 */
	public static function getStrategy($strategy) {
		if (!array_key_exists($strategy, ShiftStrategy::getStrategies())) {
			throw new \InvalidArgumentException('Invalid strategy ' . $strategy);
		}
		
		$class = __NAMESPACE__ . '\\' . studly_case($strategy);
		
		return new $class;
	}
	
	/**
	 * @param Task $task
	 * @return \App\ShiftStrategies\ShiftStrategy
	 * @throws \UnexpectedValueException
	 */
	public static function getStrategyByTask(Task $task) {
		switch ($task->type) {
			case Task::TYPE_EN: // no-break
			case Task::TYPE_ESV:
				$strategy = ShiftStrategy::LAST_WORKING_DAY;
				break;
			case Task::TYPE_ND:
				$strategy = ShiftStrategy::NEXT_WORKING_DAY;
				break;
			default:
				throw new \UnexpectedValueException('Unexpected strategy ' . $strategy);
		}
	
		return self::getStrategy($strategy);
	}
}

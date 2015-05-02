<?php namespace App\PayStrategies;

use App\Task;

class PayStrategyFactory {
	
	/**
	 * Fabric method for payment strategy
	 *
	 * @param string $strategy
	 * @throws \InvalidArgumentException
	 * @return PayStrategy
	 */
	public static function getStrategy($strategy) {
		if (!array_key_exists($strategy, Task::getStrategies())) {
			throw new \InvalidArgumentException('Invalid strategy: ' . $strategy);
		}
		
		$class = __NAMESPACE__ . '\\' . studly_case($strategy);
		
		return new $class;
	}
	
}

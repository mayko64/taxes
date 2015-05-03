<?php namespace App\PayStrategies;

/**
 * Внести оплату не позднее 20 числа месяца, за который производится оплата.
 */
class Before20 extends PayStrategy {

	public function getPayFrom() {
		$date = clone $this->date;
		$date->modify('first day of this month');
		return $date;
	}
	
	public function getPayTo() {
		$date = clone $this->date;
		$date->modify('last day of previous month');
		$date->modify('+20 days');
		return $date;
	}
}

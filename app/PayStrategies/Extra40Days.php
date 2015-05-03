<?php namespace App\PayStrategies;

/**
 * Внести оплату не позднее, чем через 40 дней после окончания месяца/квартала.
 */
class Extra40Days extends PayStrategy {

	public function getPayFrom() {
		$date = clone $this->date;
		$date->modify('+1 day');
		return $date;
	}
	
	public function getPayTo() {
		$date = clone $this->date;
		$date->modify('+40 days');
		return $date;
	}
}

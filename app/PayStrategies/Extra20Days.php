<?php namespace App\PayStrategies;

class Extra20Days extends PayStrategy {

	public function getPayFrom() {
		$date = clone $this->date;
		$date->modify('+1 day');
		return $date;
	}
	
	public function getPayTo() {
		$date = clone $this->date;
		$date->modify('+20 days');
		return $date;
	}
}

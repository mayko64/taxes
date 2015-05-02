<?php namespace App\ShiftStrategies;

class NextWorkingDay extends ShiftStrategy {

	public function shift(\DateTime $date) {
		while ($this->isHoliday($date) or $this->isWeekend($date)) {
			$date->modify('+1 day');
		}
		
		return $date;
	}
}

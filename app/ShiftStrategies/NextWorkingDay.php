<?php namespace App\ShiftStrategies;

/**
 * Если крайняя дата подачи отчета выпадает на праздничный/выходной день,
 * то крайняя дата переносится на следующий рабочий день.
 */
class NextWorkingDay extends ShiftStrategy {

	public function shift(\DateTime $date) {
		while ($this->isHoliday($date) or $this->isWeekend($date)) {
			$date->modify('+1 day');
		}
		
		return $date;
	}
}

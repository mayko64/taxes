<?php namespace App\ShiftStrategies;

/**
 * Если крайняя дата оплаты ЕН/ЕСВ выпадает на праздничный/выходной день,
 * то крайняя дата переносится на последний предшествующий рабочий день.
 */
class LastWorkingDay extends ShiftStrategy {

	public function shift(\DateTime $date) {
		while ($this->isHoliday($date) or $this->isWeekend($date)) {
			$date->modify('-1 day');
		}
		
		return $date;
	}
}

<?php namespace App;

use App\PayStrategies\PayStrategyFactory;
use App\ShiftStrategies\ShiftStrategiesFactory;
use App\ShiftStrategies\ShiftStrategy;

class Report {
	
	/**
	 * Группа налогоплательщика
	 *
	 * @var int (1-6)
	 */
	protected $group;

	/**
	 * Периодичность оплаты ЕСВ
	 *
	 * @var string (month|quarter)
	 */
	protected $esvPeriod;
	
	/**
	 * Начальная дата периода
	 *
	 * @var \DateTime
	 */
	protected $from;
	
	/**
	 * Конечная дата периода
	 *
	 * @var \DateTime
	 */
	protected $to;
	
	public function getTasks() {
		$this->check();
		
		$tasks = new TasksHeap();
		
		foreach ($this->findAvailableTasks() as $task) {
			// Точкой отсчета возьмем начало предыдущего года,
			// чтобы охватить все события, по которым могут быть актуальные задачи
			$billFrom = new \DateTime($this->from->format('Y-01-01'));
			$billFrom->sub(new \DateInterval('P1Y'));
			
			// Разобьем промежуток времени между начальной точкой и крайней датой,
			// указанной пользователем, на периоды длиной $task->period каждый
			$period = new \DatePeriod(
				$billFrom,
				$task->getInterval(),
				$this->to,
				\DatePeriod::EXCLUDE_START_DATE
			);
			
			foreach ($period as $nextBillFrom) {
				// Уточняем границу периода
				$billTo = clone $nextBillFrom;
				$billTo->sub(new \DateInterval('P1D'));
				
				// Определяем правила оплаты/подачи отчетности
				$payStrategy = PayStrategyFactory::getStrategy($task->pay_strategy);
				$payStrategy->setDate($billTo);
				
				$payDateFrom = $payStrategy->getPayFrom();
				$payDateTo = $payStrategy->getPayTo();
				
				// Уточняем даты "с"/"по", чтобы не выходить за рамки указанного периода
				$from = ($payDateFrom > $this->from) ? $payDateFrom : $this->from;
				$to =   ($payDateTo   < $this->to)   ? $payDateTo   : $this->to;

				if ($to > $this->from && $from < $this->to) {
					// Если крайний день периода попадает на выходной или праздник,
					// переносим его в соответствии с задачей либо на предыдущий, либо
					// на следующий рабочий день
					if (ShiftStrategy::isHoliday($to) or ShiftStrategy::isWeekend($to)) {
						$to = ShiftStrategiesFactory::getStrategyByTask($task)->shift($to);
					}
					
					// Корректируем дату начала отчетного периода для задач,
					// которые выполняются накопительным итогом
					if ($task->is_cummulative) {
						$billFrom = new \DateTime($billFrom->format('Y-01-01'));
					}
					
					$tasks->insert([
						'from'           => $from->getTimestamp(),
						'to'             => $to->getTimestamp(),
						'type'           => $task->type,
						'is_cummulative' => $task->is_cummulative,
						'bill_from'      => $billFrom->getTimestamp(),
						'bill_to'        => $billTo->getTimestamp(),
					]);
				}
				$billFrom = $nextBillFrom;
			}
		}
		
		return $tasks;
	}
	
	/**
	 * Возвращает список шаблонов задач, которые удовлетворяют заданным критериям
	 */
	protected function findAvailableTasks() {
		return Task::whereRaw('"group" = :group AND ("type" <> :type OR "period" = :period)', [
				'group'  => $this->group,
				'type'   => Task::TYPE_ESV,
				'period' => $this->esvPeriod,
			])
			->get();
	}

	public function setGroup($group) {
		$this->group = $group;
	}

	public function setESVPeriod($period) {
		$this->esvPeriod = $period;
	}
	
	public function setFrom($from) {
		$this->from = new \DateTime($from);
	}
	
	public function setTo($to) {
		$this->to = new \DateTime($to);
	}
	
	protected function check() {
		if (empty($this->group)) {
			throw new \RuntimeException('Group is not set');
		}
		
		if (empty($this->esvPeriod)) {
			throw new \RuntimeException('ESV Period is not set');
		}
		
		if (empty($this->from)) {
			throw new \RuntimeException('DateFrom is not set');
		}
		
		if (empty($this->to)) {
			throw new \RuntimeException('DateTo is not set');
		}
	}
}

class TasksHeap extends \SplHeap {
	
	protected function compare($task1, $task2) {
		$from1 = $task1['from'];
		$from2 = $task2['from'];
		
		if ($from1 > $from2) {
			return -1;
		} elseif ($from1 < $from2) {
			return 1;
		} else {
			return 0;
		}
	}
}

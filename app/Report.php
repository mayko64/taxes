<?php namespace App;

use App\PayStrategies\PayStrategyFactory;
use App\ShiftStrategies\ShiftStrategiesFactory;

class Report {
	
	protected $group;

	protected $esvPeriod;
	
	/**
	 *
	 * @var \DateTime
	 */
	protected $from;
	
	/**
	 *
	 * @var \DateTime
	 */
	protected $to;
	
	public function getTasks() {
		$this->check();
		
		$tasks = [];
		
		foreach ($this->findAvailableTasks() as $task) {
			$period = new \DatePeriod(
				$this->getPeriodStartDate($task),
				$task->getInterval(),
				$this->to,
				\DatePeriod::EXCLUDE_START_DATE
			);
			
			foreach ($period as $startNextPeriodDate) {
				$periodEndDate = clone $startNextPeriodDate;
				$periodEndDate->modify('-1 day');
				
				$payStrategy = PayStrategyFactory::getStrategy($task->pay_strategy);
				$payStrategy->setDate($periodEndDate);
				
				$payDateFrom = $payStrategy->getPayFrom();
				$payDateTo = $payStrategy->getPayTo();
				
				$from = ($payDateFrom > $this->from) ? $payDateFrom : $this->from;
				$to =   ($payDateTo   < $this->to)   ? $payDateTo   : $this->to;

				if ($to > $this->from && $from < $this->to) {
					$to = $this->shift($task, $to);
					
					$tasks[] = [
						'from'           => $from->getTimestamp(),
						'to'             => $to->getTimestamp(),
						'type'           => $task->type,
						'is_cummulative' => $task->is_cummulative,
					];
				}
			}
		}
		
		return $tasks;
	}
	
	protected function shift(Task $task, \DateTime $date) {
		$shiftStrategy = ShiftStrategiesFactory::getStrategyByTask($task);
		return $shiftStrategy->shift($date);
	}
	
	protected function getPeriodStartDate(Task $task) {
		$date = clone $this->from;
		$date = new \DateTime($date->format('Y-01-01'));
		return $date;
	}
	
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

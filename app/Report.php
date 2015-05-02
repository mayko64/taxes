<?php namespace App;

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

<?php namespace App\PayStrategies;

abstract class PayStrategy {
	
	/**
	 * Крайняя дата учетного периода
	 *
	 * @var \DateTime
	 */
	protected $date;
	
	/**
	 * @param \DateTime $date
	 */
	public function setDate(\DateTime $date) {
		$this->date = $date;
	}
	
	/**
	 * @return \DateTime
	 */
	abstract public function getPayFrom();
	
	/**
	 * @return \DateTime
	 */
	abstract public function getPayTo();
}

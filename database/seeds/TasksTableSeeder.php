<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Task;
use Illuminate\Support\Facades\Lang;

class TasksTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		
		DB::table('tasks')->delete();
		
		// Подача налоговых деклараций
		Task::create(['type' => Task::TYPE_ND, 'group' => Task::GROUP_1, 'period' => Task::PERIOD_YEAR, 'pay_strategy' => Task::STRATEGY_EXTRA_40_DAYS]);
		Task::create(['type' => Task::TYPE_ND, 'group' => Task::GROUP_2, 'period' => Task::PERIOD_YEAR, 'pay_strategy' => Task::STRATEGY_EXTRA_40_DAYS]);
		Task::create(['type' => Task::TYPE_ND, 'group' => Task::GROUP_3, 'period' => Task::PERIOD_QUARTER, 'pay_strategy' => Task::STRATEGY_EXTRA_40_DAYS, 'is_cummulative' => true]);
		Task::create(['type' => Task::TYPE_ND, 'group' => Task::GROUP_4, 'period' => Task::PERIOD_QUARTER, 'pay_strategy' => Task::STRATEGY_EXTRA_40_DAYS, 'is_cummulative' => true]);
		Task::create(['type' => Task::TYPE_ND, 'group' => Task::GROUP_5, 'period' => Task::PERIOD_QUARTER, 'pay_strategy' => Task::STRATEGY_EXTRA_40_DAYS, 'is_cummulative' => true]);
		Task::create(['type' => Task::TYPE_ND, 'group' => Task::GROUP_6, 'period' => Task::PERIOD_QUARTER, 'pay_strategy' => Task::STRATEGY_EXTRA_40_DAYS, 'is_cummulative' => true]);
		
		// Оплата ЕН
		Task::create(['type' => Task::TYPE_EN, 'group' => Task::GROUP_1, 'period' => Task::PERIOD_MONTH, 'pay_strategy' => Task::STRATEGY_BEFORE_20]);
		Task::create(['type' => Task::TYPE_EN, 'group' => Task::GROUP_2, 'period' => Task::PERIOD_MONTH, 'pay_strategy' => Task::STRATEGY_BEFORE_20]);
		Task::create(['type' => Task::TYPE_EN, 'group' => Task::GROUP_3, 'period' => Task::PERIOD_QUARTER, 'pay_strategy' => Task::STRATEGY_EXTRA_50_DAYS]);
		Task::create(['type' => Task::TYPE_EN, 'group' => Task::GROUP_4, 'period' => Task::PERIOD_QUARTER, 'pay_strategy' => Task::STRATEGY_EXTRA_50_DAYS]);
		Task::create(['type' => Task::TYPE_EN, 'group' => Task::GROUP_5, 'period' => Task::PERIOD_QUARTER, 'pay_strategy' => Task::STRATEGY_EXTRA_50_DAYS]);
		Task::create(['type' => Task::TYPE_EN, 'group' => Task::GROUP_6, 'period' => Task::PERIOD_QUARTER, 'pay_strategy' => Task::STRATEGY_EXTRA_50_DAYS]);
		
		// Оплата ЕСВ
		Task::create(['type' => Task::TYPE_ESV, 'group' => Task::GROUP_1, 'period' => Task::PERIOD_MONTH, 'pay_strategy' => Task::STRATEGY_EXTRA_20_DAYS]);
		Task::create(['type' => Task::TYPE_ESV, 'group' => Task::GROUP_2, 'period' => Task::PERIOD_MONTH, 'pay_strategy' => Task::STRATEGY_EXTRA_20_DAYS]);
		Task::create(['type' => Task::TYPE_ESV, 'group' => Task::GROUP_3, 'period' => Task::PERIOD_MONTH, 'pay_strategy' => Task::STRATEGY_EXTRA_20_DAYS]);
		Task::create(['type' => Task::TYPE_ESV, 'group' => Task::GROUP_5, 'period' => Task::PERIOD_MONTH, 'pay_strategy' => Task::STRATEGY_EXTRA_20_DAYS]);
		Task::create(['type' => Task::TYPE_ESV, 'group' => Task::GROUP_1, 'period' => Task::PERIOD_QUARTER, 'pay_strategy' => Task::STRATEGY_EXTRA_20_DAYS]);
		Task::create(['type' => Task::TYPE_ESV, 'group' => Task::GROUP_2, 'period' => Task::PERIOD_QUARTER, 'pay_strategy' => Task::STRATEGY_EXTRA_20_DAYS]);
		Task::create(['type' => Task::TYPE_ESV, 'group' => Task::GROUP_3, 'period' => Task::PERIOD_QUARTER, 'pay_strategy' => Task::STRATEGY_EXTRA_20_DAYS]);
		Task::create(['type' => Task::TYPE_ESV, 'group' => Task::GROUP_5, 'period' => Task::PERIOD_QUARTER, 'pay_strategy' => Task::STRATEGY_EXTRA_20_DAYS]);
	}

}

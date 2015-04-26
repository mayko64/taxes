<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Holiday;
use Illuminate\Support\Facades\Lang;

class HolidaysTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		
		DB::table('holidays')->delete();
		
		Holiday::create(['date' => '2015-01-01', 'description' => trans('holidays.new_year')]);
		Holiday::create(['date' => '2015-01-07', 'description' => trans('holidays.christmas')]);
		Holiday::create(['date' => '2015-03-08', 'description' => trans('holidays.march8')]);
		Holiday::create(['date' => '2015-04-12', 'description' => trans('holidays.easter')]);
		Holiday::create(['date' => '2015-05-01', 'description' => trans('holidays.may1')]);
		Holiday::create(['date' => '2015-05-02', 'description' => trans('holidays.may1')]);
		Holiday::create(['date' => '2015-05-09', 'description' => trans('holidays.victory_day')]);
		Holiday::create(['date' => '2015-05-31', 'description' => trans('holidays.pentecost')]);
		Holiday::create(['date' => '2015-06-28', 'description' => trans('holidays.constitution_day')]);
		Holiday::create(['date' => '2015-08-24', 'description' => trans('holidays.independence_day')]);
		Holiday::create(['date' => '2015-10-14', 'description' => trans('holidays.defenders_day')]);
	}

}

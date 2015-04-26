<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Holiday;

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
		
		Holiday::create(['date' => '2015-01-01', 'description' => 'Новый год']);
		Holiday::create(['date' => '2015-01-07', 'description' => 'Рождество Христово']);
		Holiday::create(['date' => '2015-03-08', 'description' => 'Международный женский день']);
		Holiday::create(['date' => '2015-04-12', 'description' => 'Пасха']);
		Holiday::create(['date' => '2015-05-01', 'description' => 'День международной солидарности трудящихся']);
		Holiday::create(['date' => '2015-05-02', 'description' => 'День международной солидарности трудящихся']);
		Holiday::create(['date' => '2015-05-09', 'description' => 'День Победы']);
		Holiday::create(['date' => '2015-05-31', 'description' => 'Троица']);
		Holiday::create(['date' => '2015-06-28', 'description' => 'День Конституции Украины']);
		Holiday::create(['date' => '2015-08-24', 'description' => 'День независимости Украины']);
		Holiday::create(['date' => '2015-10-14', 'description' => 'День защитника Украины']);
	}

}

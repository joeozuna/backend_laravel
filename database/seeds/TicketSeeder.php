<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tickets')->insert([
            'event_name' => 'Concierto estrellas del vallenato',
            'quantity' => '500',
            'start_time' => '2020-11-01 00:00:01',
            'finish_time' => '2020-11-10 23:59:00',
            'description' => 'Las mejores estrellas del vallenato se presentan en vivo este 15 de noviembre de 2020'
        ]);
    }
}

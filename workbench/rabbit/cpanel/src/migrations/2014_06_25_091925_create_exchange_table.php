<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExchangeTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'cp_exchange',
            function (Blueprint $table) {
                $table->increments('id');
                $table->date('exchange_date');
                $table->decimal('khr_usd', 12, 2);
                $table->decimal('usd', 12, 2);
                $table->decimal('khr_thb', 12, 2);
                $table->decimal('thb', 12, 2);
                $table->text('memo');
                $table->timestamps();
            }
        );

        // Call seeder
        $this->seeder();
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cp_exchange');
    }

    /**
     * Seeder
     *
     * @return void
     */
    private function seeder()
    {
        DB::table('cp_exchange')->insert(
            [
                [
                    'exchange_date' => '2015-01-01',
                    'khr_usd' => 4000,
                    'usd' => 1,
                    'khr_thb' => 100,
                    'thb' => 1,
                    'memo' => 'Testing',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ],
            ]
        );
    }
}

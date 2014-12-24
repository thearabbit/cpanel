<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrencyTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'cp_currency',
            function (Blueprint $table) {
                $table->string('id', 5);
                $table->primary('id');
                $table->string('name');
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
        Schema::drop('cp_currency');
    }

    /**
     * Seeder
     *
     * @return void
     */
    private function seeder()
    {
        DB::table('cp_currency')->insert(
            [
                [
                    'id' => '1',
                    'name' => 'KHR',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ],
                [
                    'id' => '2',
                    'name' => 'USD',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ],
                [
                    'id' => '5',
                    'name' => 'THB',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ],
            ]
        );
    }
}

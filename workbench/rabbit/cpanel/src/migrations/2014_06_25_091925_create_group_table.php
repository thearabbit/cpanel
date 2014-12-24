<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'cp_group',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('package');
                $table->text('permission');
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
        Schema::drop('cp_group');
    }

    /**
     * Seeder
     *
     * @return void
     */
    private function seeder()
    {
        DB::table('cp_group')->insert(
            array(
                array(
                    'name' => 'Super',
                    'package' => 'cpanel',
                    'permission' => '[]',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ),
            )
        );
    }
}

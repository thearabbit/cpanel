<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'cp_user',
            function (Blueprint $table) {
                $table->string('id', 5);
                $table->primary('id');
                $table->string('full_name');
                $table->string('email');
                $table->string('type');
                $table->text('group');
                $table->text('branch');
                $table->string('username');
                $table->string('password');
                $table->string('password_action');
                $table->string('activated');
                $table->string('owner_id');
                $table->string('remember_token');
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
        Schema::drop('cp_user');
    }

    /**
     * Seeder
     *
     * @return void
     */
    private function seeder()
    {
        DB::table('cp_user')->insert(
            array(
                array(
                    'id' => '001',
                    'full_name' => 'Yuom Theara',
                    'email' => 'yuom.theara@gmail.com',
                    'type' => 'Super',
                    'group' => '["1"]',
                    'branch' => '["001"]',
                    'username' => 'super',
                    'password' => Hash::make('super123456'),
                    'password_action' => Hash::make('super123456'),
                    'activated' => 'Yes',
                    'owner_id' => '',
                    'remember_token' => '',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ),
            )
        );
    }
}

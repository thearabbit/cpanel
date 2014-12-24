<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'cp_branch',
            function (Blueprint $table) {
                $table->string('id', 5);
                $table->primary('id');
                $table->string('kh_name');
                $table->string('kh_short_name');
                $table->string('en_name');
                $table->string('en_short_name');
                $table->text('kh_address');
                $table->text('en_address');
                $table->string('telephone');
                $table->string('email');
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
        Schema::drop('cp_branch');
    }

    /**
     * Seeder
     *
     * @return void
     */
    private function seeder()
    {
        DB::table('cp_branch')->insert(
            array(
                array(
                    'id' => '001',
                    'kh_name' => 'សាខាបាត់ដំបង',
                    'kh_short_name' => 'បប',
                    'en_name' => 'Battambang',
                    'en_short_name' => 'BTB',
                    'kh_address' => 'ផ្លូវជាតិលេខ ៥ ភូមិរំចេក ៤ សង្កាត់រតនៈ ក្រុងបាត់ដំបង ខេត្តបាត់ដំបង',
                    'en_address' => 'Str 5, Romchek 4 Village, Sangkat Rottanak, Krong Battambang, Battambang Province',
                    'telephone' => '053 50 66 777',
                    'email' => '',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ),
            )
        );
    }
}

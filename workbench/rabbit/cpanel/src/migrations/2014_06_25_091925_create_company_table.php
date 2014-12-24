<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'cp_company',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('kh_name');
                $table->string('kh_short_name');
                $table->string('en_name');
                $table->string('en_short_name');
                $table->text('kh_address');
                $table->text('en_address');
                $table->string('telephone');
                $table->string('email');
                $table->string('website');
                $table->string('logo');
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
        Schema::drop('cp_company');
    }

    /**
     * Seeder
     *
     * @return void
     */
    private function seeder()
    {
        DB::table('cp_company')->insert(
            array(
                array(
                    'kh_name' => 'មជ្ឈមណ្ឌលបណ្តុះបណ្តាល រ៉ាប៊ីត',
                    'kh_short_name' => 'មបរ',
                    'en_name' => 'Rabbit Training Center',
                    'en_short_name' => 'RTC',
                    'kh_address' => 'ផ្លូវជាតិលេខ ៥ ភូមិរំចេក ៤ សង្កាត់រតនៈ ក្រុងបាត់ដំបង ខេត្តបាត់ដំបង',
                    'en_address' => 'Str 5, Romchek 4 Village, Sangkat Rottanak, Krong Battambang, Battambang Province',
                    'telephone' => '053 50 66 777',
                    'email' => '',
                    'website' => 'rabbittc.blogspot.com',
                    'logo' => '',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ),
            )
        );
    }
}

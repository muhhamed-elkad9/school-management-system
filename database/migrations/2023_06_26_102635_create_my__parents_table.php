<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my__parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('roles_name')->default('{"ar":"ولي أمر","en":"Parents"}');

            //Fatherinformation
            $table->string('Name_Father');
            $table->string('National_ID_Father');
            $table->string('Passport_ID_Father');
            $table->string('Phone_Father');
            $table->string('Job_Father');
            $table->bigInteger('Nationality_Father_id')->unsigned();
            $table->bigInteger('Blood_Type_Father_id')->unsigned();
            $table->bigInteger('Religion_Father_id')->unsigned();
            $table->string('Address_Father');

            //Mother information
            $table->string('Name_Mother');
            $table->string('National_ID_Mother');
            $table->string('Passport_ID_Mother');
            $table->string('Phone_Mother');
            $table->string('Job_Mother');
            $table->bigInteger('Nationality_Mother_id')->unsigned();
            $table->bigInteger('Blood_Type_Mother_id')->unsigned();
            $table->bigInteger('Religion_Mother_id')->unsigned();
            $table->string('Address_Mother');

            //foreign information
            $table->foreign('Nationality_Father_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Father_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Father_id')->references('id')->on('religions');
            $table->foreign('Nationality_Mother_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Mother_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Mother_id')->references('id')->on('religions');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my__parents');
    }
}

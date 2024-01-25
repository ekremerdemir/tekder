<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_surname')->nullable();
            $table->integer('identity')->nullable();
            $table->date('birthyear')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->longText('address')->nullable();
            $table->string('member_type')->nullable();
            $table->string('derbis')->nullable();
            $table->string('durum')->nullable();
            $table->date('registration')->nullable();
            $table->date('decision_date')->nullable();
            $table->integer('numberdecisions')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

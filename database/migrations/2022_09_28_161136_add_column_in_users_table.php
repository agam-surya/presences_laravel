<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //menamahkan beberapa komlumn setelah kolumn password           
            $table->after('password', function (Blueprint $table) {
                $table->foreignId('role_id')->constrained();
                $table->string('phone')->unique()->nullable();
                $table->foreignId('position_id')->constrained();    
                $table->string('name');
                $table->string('image');
                $table->string('address');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id','position_id']);
            $table->dropColumn(['role_id','position_id','phone','name','image','address']);
        });
    }
}

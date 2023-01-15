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
            //menamahkan beberapa kolumn setelah kolumn password           
            $table->after('password', function (Blueprint $table) {
                $table->foreignId('role_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
                $table->foreignId('position_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
                $table->string('phone')->nullable();
                // $table->foreignId('position_id')->constrained();
                $table->string('name');
                $table->string('image')->nullable();
                $table->string('address');
                // $table->string('macAdress')->nullable();
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
            $table->dropColumn(['role_id', 'position_id','phone', 'name', 'image', 'address']);
        });
    }
}

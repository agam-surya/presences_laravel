<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInPresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presences', function (Blueprint $table) {
            //
            $table->after('id', function (Blueprint $table) {
                $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
                $table->foreignId('attendance_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::table('presences', function (Blueprint $table) {
            //
            $table->dropForeign(['user_id','attendance_id']);
            $table->dropColumn(['user_id','attendance_id']);
        });
    }
}

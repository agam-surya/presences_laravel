<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            //
            $table->after('id', function (Blueprint $table){
                $table->foreignId('permission__type_id')->constrained();
                $table->foreignId('user_id')->constrained();
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
        Schema::table('permission', function (Blueprint $table) {
            //
            $table->dropForeign(['permission_type_id','user_id']);
            $table->dropColumn(['permission_type_id','user_id']);
        });
    }
}

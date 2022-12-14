<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            // -> user_id =int
            // $table->foreignId('user_id');
            // -> attendece_id =int
            // $table->foreignId('attendece_id');
            $table->date("presence_date");
            $table->time("presence_enter_time");
            $table->decimal('latitude', 12,5);
            $table->decimal('longitude', 12,5);
            $table->time("presence_out_time")->nullable();
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
        Schema::dropIfExists('presences');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('submissions', function (Blueprint $table) {

        // ADD
        $table->unsignedBigInteger('add_unit_id')->nullable();
        $table->unsignedBigInteger('add_room_id')->nullable();
        $table->string('add_name')->nullable();
        $table->integer('add_quantity')->nullable();
        $table->string('add_unit')->nullable();
        $table->string('add_condition')->nullable();
        $table->integer('add_acquired_year')->nullable();
        $table->string('add_photo')->nullable();

        // UPDATE
        $table->string('old_condition')->nullable();
        $table->integer('old_quantity')->nullable();
        $table->string('update_photo')->nullable();

        // DELETE
        $table->string('delete_photo')->nullable();
    });
}

public function down()
{
    Schema::table('submissions', function (Blueprint $table) {
        $table->dropColumn([
            'add_unit_id','add_room_id','add_name','add_quantity','add_unit',
            'add_condition','add_acquired_year','add_photo',
            'old_condition','old_quantity','update_photo',
            'delete_photo'
        ]);
    });
}

};

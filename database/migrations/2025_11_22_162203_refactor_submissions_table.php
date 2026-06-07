<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
            $table->string('photo')->nullable();
            $table->dropColumn(['add_photo','update_photo','delete_photo']);
        });
    }

    public function down() {
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('add_photo')->nullable();
            $table->string('update_photo')->nullable();
            $table->string('delete_photo')->nullable();
        });
    }
};


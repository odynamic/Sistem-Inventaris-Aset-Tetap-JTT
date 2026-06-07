<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    DB::statement("ALTER TABLE submissions MODIFY type ENUM('add','update','delete')");
}

public function down()
{
    DB::statement("ALTER TABLE submissions MODIFY type VARCHAR(50)");
}

};

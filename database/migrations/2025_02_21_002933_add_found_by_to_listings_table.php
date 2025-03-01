<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('listings', function (Blueprint $table) {
        $table->foreignId('found_by')
              ->nullable()
              ->constrained('users')
              ->after('is_found');
    });
}

public function down()
{
    Schema::table('listings', function (Blueprint $table) {
        $table->dropConstrainedForeignId('found_by');
    });
}

};

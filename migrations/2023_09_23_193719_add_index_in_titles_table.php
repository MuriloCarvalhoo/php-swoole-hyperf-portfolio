<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AddIndexInTitlesTable extends Migration
{
    public function up(): void
    {
        Schema::table('titles', function (Blueprint $table) {
            //
        });
    }

    public function down(): void
    {
        Schema::table('titles', function (Blueprint $table) {
            //
        });
    }
}

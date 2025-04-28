<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image')->nullable()->after('jurusan'); // sesuaikan posisi
        });
    
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('image')->nullable()->after('description'); // sesuaikan posisi
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
    
};

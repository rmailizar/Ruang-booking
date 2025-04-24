<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_hp')->nullable()->after('email');
            $table->string('nim')->nullable()->after('no_hp'); // Letakkan setelah email
            $table->string('jurusan')->nullable()->after('nim'); // Letakkan setelah nim
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_hp','nim', 'jurusan']);
        });
    }
    
};

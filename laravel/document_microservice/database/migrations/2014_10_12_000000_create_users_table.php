<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username', 100)->unique()->nullable();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('type', 30);
            $table->string('password');            
            $table->text('bio')->nullable();            
            $table->string('image')->nullable();            
            $table->integer('is_verified_email')->default(0);            
            $table->integer('is_verified')->default(0);
            
            //authentication
            $table->string('apikey', 550)->nullable();
            $table->timestamp('key_created')->nullable();
            $table->timestamp('key_expire')->nullable();

            //$table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

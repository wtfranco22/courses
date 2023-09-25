<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->nullable(false);
            $table->string('last_name',50)->nullable(false);
            $table->string('address',100)->nullable(false);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at');
            $table->string('password')->nullable(false);
            $table->foreignIdFor(\App\Models\Role::class);
            $table->boolean('enabled')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
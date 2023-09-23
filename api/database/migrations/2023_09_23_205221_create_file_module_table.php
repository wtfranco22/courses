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
        Schema::create('file_module', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Module::class);
            $table->foreignIdFor(\App\Models\File::class);
            $table->unsignedSmallInteger('order');
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
        Schema::dropIfExists('file_module');
    }
};

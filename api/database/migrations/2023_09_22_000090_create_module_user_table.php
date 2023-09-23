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
        Schema::create('module_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Module::class);
            $table->foreignIdFor(\App\Models\User::class);
            $table->boolean('enabled')->default(false);
            $table->enum('state', ['not started', 'in progress', 'almost complete', 'complete'])->default('not started');
            $table->decimal('calification', 3, 2)->default(0.0);
            $table->longText('description');
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
        Schema::dropIfExists('module_user');
    }
};

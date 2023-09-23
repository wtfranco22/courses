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
        Schema::create('course_user', function (Blueprint $table) {
            $table->id();
            $table->date('inscription_date')->nullable(false);
            $table->decimal('payment_amount', 10, 2)->nullable(false);
            $table->integer('completion_percentage')->default(0);
            $table->decimal('average_grade',5,2)->default(0.0);
            $table->string('certificate');
            $table->foreignIdFor(\App\Models\Course::class);
            $table->foreignIdFor(\App\Models\User::class);
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
        Schema::dropIfExists('course_user');
    }
};

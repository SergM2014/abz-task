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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->foreignId('position_id')->constrained();
            $table->integer('leader_id');
            $table->date('employment_date');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->float('salary', 6, 3);
            $table->string('photo')->nullable();
            $table->integer('admin_created_id')->nullable();
            $table->integer('admin_updated_id')->nullable();
            $table->timestamps();
            $table->index(['first_name', 'middle_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};

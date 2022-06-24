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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('invoice')->unique();
            $table->uuid()->unique();
            $table->integer('total_items')->default(0);
            $table->unsignedDouble('subtotal')->default(0);
            $table->unsignedFloat('discount')->default(0);
            $table->unsignedDouble('saved')->default(0);
            $table->unsignedDouble('total')->default(0);
            $table->unsignedDouble('received')->default(0);
            $table->double('change')->default(0);
            $table->string('notes')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};

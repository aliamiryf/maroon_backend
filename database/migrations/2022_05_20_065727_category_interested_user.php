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
        Schema::create('category_interested_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->unique();
            $table->string('token_id')->nullable();
            $table->foreignId('category_id')->unique();
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
        Schema::dropIfExists('category_interested_user');
    }
};

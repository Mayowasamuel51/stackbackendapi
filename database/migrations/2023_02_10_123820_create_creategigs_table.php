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
        Schema::create('creategigs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('ptitle')->nullable();
            $table->string('language_category')->nullable();
            $table->string('problem_descritpion')->nullable(); 
            $table->string('images')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('creategigs')->onDelete('cascade');
            $table->string('problem_descritpion')->nullable();
            $table->string('images')->nullable();
            // $table->string('portfolio_url')->nullable();
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
        Schema::dropIfExists('creategigs');
    }
};

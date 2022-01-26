<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->references('id')->on('companies')->onDelete('SET NULL');
            $table->foreignId('building_id')->nullable()->references('id')->on('buildings')->onDelete('SET NULL');
            $table->foreignId('client_id')->nullable()->references('id')->on('clients')->onDelete('SET NULL');
            $table->string('address');
            $table->string('street', 128)->default('');
            $table->string('house', 32)->default('');
            $table->string('block', 32)->default('');
            $table->string('flat', 32)->default('');
            $table->string('postcode', 64)->default('');
            $table->unique(['address', 'street', 'house', 'block', 'flat', 'postcode']);
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
        Schema::dropIfExists('places');
    }
}

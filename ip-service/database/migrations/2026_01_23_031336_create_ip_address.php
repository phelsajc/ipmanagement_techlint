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
        Schema::create('ipaddress', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address'); // IPv4 or IPv6
            $table->string('title');
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('created_by'); // User ID
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
        Schema::dropIfExists('ipaddress');
    }
};

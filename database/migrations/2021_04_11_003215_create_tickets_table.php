<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('tag_id');
            $table->text('note')->nullable();
            $table->boolean('active')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('assigned_to');
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('activity_id')->references('id')->on('activities');
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('assigned_to')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}

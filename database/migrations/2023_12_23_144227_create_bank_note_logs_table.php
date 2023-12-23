<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankNoteLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_note_logs', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('email');
            $table->integer('amount');
            $table->tinyInteger('status');
            $table->longText('additional_data');
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
        Schema::dropIfExists('bank_note_logs');
    }
}

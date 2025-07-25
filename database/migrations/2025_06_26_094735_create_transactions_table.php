<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('reference')->unique();
            $table->decimal('montant', 12, 2);
            $table->unsignedBigInteger('modereglement_id')->nullable();
            $table->enum('typeoperation', ['depot', 'retrait', 'transfert']);
            $table->enum('status', ['encours', 'succes', 'echec'])->default('encours');
            $table->text('observation')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('modereglement_id')->references('id')->on('mode_reglements')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

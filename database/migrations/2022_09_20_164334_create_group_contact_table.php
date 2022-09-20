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
        Schema::create('group_contact', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('charge_id')->nullable();

            $table->foreign('group_id')->references('id')->on('groups')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('contact_id')->references('id')->on('contacts')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['group_id', 'contact_id']);

            $table->unique(array('group_id', 'contact_id', 'company_id', 'charge_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_contact');
    }
};

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
        Schema::create('client_contact_person', function (Blueprint $table) {
            $table->uuid('id')->index();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->integer('phone')->nullable();
            $table->string('job_position')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignUuid('client_id')
                ->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_contact_person');
    }
};

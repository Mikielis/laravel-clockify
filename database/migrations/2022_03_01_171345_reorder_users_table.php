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
        DB::statement("ALTER TABLE users MODIFY COLUMN updated_at TIMESTAMP AFTER social_type");
        DB::statement("ALTER TABLE users MODIFY COLUMN created_at TIMESTAMP AFTER updated_at");
        DB::statement("ALTER TABLE users MODIFY COLUMN deleted_at TIMESTAMP AFTER social_type");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

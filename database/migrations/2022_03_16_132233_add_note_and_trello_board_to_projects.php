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
        Schema::table('projects', function (Blueprint $table) {
            Schema::table('projects', function ($table) {
                $table->string('trello_board', 255)->nullable();
                $table->string('note', 400)->nullable();
            });
        });

        DB::statement("ALTER TABLE projects MODIFY COLUMN client_id CHAR(36) AFTER dev_time_limit");
        DB::statement("ALTER TABLE projects MODIFY COLUMN trello_board VARCHAR(255) AFTER client_id");
        DB::statement("ALTER TABLE projects MODIFY COLUMN note VARCHAR(400) AFTER trello_board");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('trello_board');
            $table->dropColumn('note');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Client;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timesheet', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });

        DB::statement("ALTER TABLE timesheet MODIFY COLUMN deleted_at TIMESTAMP AFTER user_id");
        DB::statement("ALTER TABLE timesheet MODIFY COLUMN created_at TIMESTAMP AFTER deleted_at");
        DB::statement("ALTER TABLE timesheet MODIFY COLUMN updated_at TIMESTAMP AFTER created_at");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timesheet', function (Blueprint $table) {
            $table->dropForeignIdFor(Client::class,'user_id');
            $table->dropIndex('timesheet_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};

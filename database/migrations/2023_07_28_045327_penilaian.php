<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $trigger = <<<EOT
            CREATE TRIGGER penilaian
            AFTER INSERT ON choice_users FOR EACH ROW
            BEGIN

            END;
        EOT;

        DB::unprepared($trigger);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $trigger = 'DROP TRIGGER IF EXISTS penilaian';
        DB::unprepared($trigger);
    }
};

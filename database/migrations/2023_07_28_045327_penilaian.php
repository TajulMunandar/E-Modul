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
                DECLARE total_soal INT;
                DECLARE total_benar INT;
                DECLARE nilai DECIMAL(5, 2);

                SELECT COUNT(*) INTO total_soal FROM questions WHERE quizId = NEW.quizId;
                SELECT COUNT(*) INTO total_benar FROM jawabans WHERE questionId IN (SELECT id FROM questions WHERE quizId = NEW.quizId) AND status = 1 AND id IN (SELECT jawabanId FROM choice_users WHERE userId = NEW.userId);
                SET nilai = (total_benar / total_soal) * 100;

                INSERT INTO skor (userId, quizId, nilai) VALUES (NEW.userId, NEW.quizId, nilai)
                ON DUPLICATE KEY UPDATE nilai = nilai;
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

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
                DECLARE QuizId INT;
                DECLARE nilai DECIMAL(5, 2);

                SELECT q.id INTO QuizId FROM choice_users cu JOIN jawabans j ON cu.jawabanId = j.id JOIN questions que ON j.questionId = que.id JOIN quizzes q ON que.quizId = q.id WHERE cu.id = NEW.id;
                SELECT COUNT(*) INTO total_soal FROM questions WHERE quizId = QuizId;
                SELECT COUNT(*) INTO total_benar FROM jawabans WHERE questionId IN (SELECT id FROM questions WHERE quizId = QuizId) AND status = 1 AND id IN (SELECT jawabanId FROM choice_users WHERE userId = NEW.userId);
                SET nilai = (total_benar / total_soal) * 100;

                IF EXISTS (SELECT * FROM scores WHERE userId = NEW.userId AND quizId = QuizId) THEN
                    UPDATE scores SET nilai = nilai WHERE userId = NEW.userId AND quizId = QuizId;
                ELSE
                    INSERT INTO scores (userId, status, quizId, nilai) VALUES (NEW.userId, true, QuizId, nilai);
                END IF;
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

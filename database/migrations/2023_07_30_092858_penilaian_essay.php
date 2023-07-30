<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $trigger = <<<EOT
            CREATE TRIGGER penilaian_essay
            AFTER INSERT ON essay_users FOR EACH ROW
            BEGIN
                DECLARE QuizId INT;
                SELECT qu.id INTO QuizId FROM essay_users eu JOIN questions q ON eu.questionId = q.id JOIN quizzes qu ON q.quizId = qu.id WHERE eu.id = NEW.id;
                IF NOT EXISTS (SELECT * FROM scores WHERE userId = NEW.userId AND quizId = QuizId) THEN
                    INSERT INTO scores (userId, status, quizId, nilai) VALUES (NEW.userId, false, QuizId, 0);
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
        $trigger = 'DROP TRIGGER IF EXISTS penilaian_essay';
        DB::unprepared($trigger);
    }
};

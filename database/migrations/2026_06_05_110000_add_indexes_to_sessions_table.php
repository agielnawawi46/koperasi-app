<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $existingIndexes = collect(DB::select('SHOW INDEX FROM sessions'))->pluck('Key_name');

        if (! $existingIndexes->contains('sessions_user_id_index')) {
            DB::statement('ALTER TABLE sessions ADD INDEX sessions_user_id_index (user_id)');
        }

        if (! $existingIndexes->contains('sessions_last_activity_index')) {
            DB::statement('ALTER TABLE sessions ADD INDEX sessions_last_activity_index (last_activity)');
        }
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE sessions DROP INDEX sessions_user_id_index');
        DB::statement('ALTER TABLE sessions DROP INDEX sessions_last_activity_index');
    }
};

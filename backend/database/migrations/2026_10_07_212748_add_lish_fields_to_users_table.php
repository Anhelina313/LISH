<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')
                ->after('id')
                ->constrained('roles')
                ->restrictOnDelete();

            $table->foreignId('status_id')
                ->after('role_id')
                ->constrained('user_statuses')
                ->restrictOnDelete();

            $table->string('profile_photo_path')
                ->nullable()
                ->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['status_id']);

            $table->dropColumn([
                'role_id',
                'status_id',
                'profile_photo_path',
            ]);
        });
    }
};

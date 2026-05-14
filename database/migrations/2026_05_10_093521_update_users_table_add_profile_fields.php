<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }

            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->string('profile_image')->nullable();
            }

            if (!Schema::hasColumn('users', 'notify_email')) {
                $table->boolean('notify_email')->default(true);
            }

            if (!Schema::hasColumn('users', 'notify_sms')) {
                $table->boolean('notify_sms')->default(true);
            }
        });
    }

    public function down(): void {}
};

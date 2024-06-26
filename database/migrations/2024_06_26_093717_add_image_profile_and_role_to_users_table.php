<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //php artisan make:migration add_image_profile_and_role_to_users_table --table=users

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image_profile')->nullable()->after('password');
            $table->enum('role', ['user', 'admin'])->default('user')->after('image_profile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image_profile');
            $table->dropColumn('role');
        });
    }
};

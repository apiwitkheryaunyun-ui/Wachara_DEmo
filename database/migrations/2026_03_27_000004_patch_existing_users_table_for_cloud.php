<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            if (!Schema::hasColumn('users', 'username')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('username', 60)->nullable()->after('id');
                });

                $users = DB::table('users')->select('id', 'email')->orderBy('id')->get();
                foreach ($users as $user) {
                    $base = $user->email ? strstr($user->email, '@', true) : ('user' . $user->id);
                    $candidate = $base ?: ('user' . $user->id);
                    $suffix = 1;

                    while (DB::table('users')->where('username', $candidate)->where('id', '!=', $user->id)->exists()) {
                        $candidate = $base . $suffix;
                        $suffix++;
                    }

                    DB::table('users')->where('id', $user->id)->update(['username' => $candidate]);
                }
            }

            if (!Schema::hasColumn('users', 'role')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->enum('role', ['admin', 'stock', 'viewer'])->default('stock')->after('password');
                });
            }

            if (!Schema::hasColumn('users', 'is_active')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->boolean('is_active')->default(true)->after('role');
                });
            }
        }

        if (Schema::hasTable('categories') && !Schema::hasColumn('categories', 'sort_order')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->unsignedInteger('sort_order')->default(0)->after('description');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('categories') && Schema::hasColumn('categories', 'sort_order')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }

        if (Schema::hasTable('users')) {
            if (Schema::hasColumn('users', 'is_active')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('is_active');
                });
            }

            if (Schema::hasColumn('users', 'role')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('role');
                });
            }

            if (Schema::hasColumn('users', 'username')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('username');
                });
            }
        }
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('email');
            $table->string('avatar')->nullable()->default('default-avatar.jpg')->after('username');
            $table->enum('status', [1, 2, 3, 4])->default(1)->comment('1: pending, 2: active, 3: banned, 4: inactive');
            $table->boolean('is_admin')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('avatar');
            $table->dropColumn('status');
            $table->dropColumn('is_admin');
        });
    }
}

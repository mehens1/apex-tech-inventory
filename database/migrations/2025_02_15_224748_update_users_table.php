<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add is_customer column with default value false
            $table->boolean('is_customer')->default(false)->after('remember_token');
            // Make role_id column nullable
            $table->unsignedBigInteger('role_id')->nullable()->change();
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
            // Drop is_customer column
            $table->dropColumn('is_customer');
            // Revert role_id column to not nullable
            $table->unsignedBigInteger('role_id')->nullable(false)->change();
        });
    }
}
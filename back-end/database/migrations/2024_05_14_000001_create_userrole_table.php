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
        Schema::create('tbl_user_role', function (Blueprint $table) {
            $table->id('user_role_id');
            $table->id('user_id');
            $table->id('role_id');
            $table->timestamps();

            $table->primary(['user_id', 'role_id']);

            $table->foreign('user_id')->references('admin_id')->on('tbl_admin');
            $table->foreign('role_id')->references('role_id')->on('tbl_role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user_role');
    }
};

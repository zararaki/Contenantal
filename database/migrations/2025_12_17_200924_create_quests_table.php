<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('difficulty', ['F', 'E', 'D', 'C', 'B', 'A', 'S']);
            $table->integer('xp_reward');
            $table->integer('gold_reward');
            $table->foreignId('client_id')->nullable()->constrained('custom_users');
            $table->foreignId('admin_id')->nullable()->constrained('custom_users');
            $table->foreignId('hunter_id')->nullable()->constrained('custom_users');
            $table->enum('status', ['pending_approval', 'approved', 'in_progress', 'submitted', 'completed', 'rejected'])->default('pending_approval');
            $table->text('proof')->nullable();
            $table->string('proof_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quests');
    }
};

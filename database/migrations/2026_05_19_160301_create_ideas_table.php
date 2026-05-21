<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the `ideas` database table with its columns and constraints.
     *
     * The table includes an auto-incrementing primary key `id`, a `user_id` foreign key
     * referencing `users` with cascade delete, `title`, nullable `description`, a `status`
     * column defaulting to 'pending', a JSON `links` column defaulting to an empty array,
     * nullable `image`, and `created_at`/`updated_at` timestamps.
     */
    public function up(): void
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('status')->default('pending');
            $table->json('links')->default(json_encode([]));
            $table->string('image')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};

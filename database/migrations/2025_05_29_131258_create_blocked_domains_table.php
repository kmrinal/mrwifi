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
        Schema::create('blocked_domains', function (Blueprint $table) {
            $table->id();
            $table->string('domain')->index();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->boolean('block_subdomains')->default(true);
            $table->boolean('is_active')->default(true);
            $table->string('source')->default('manual'); // manual, import, api
            $table->json('metadata')->nullable(); // For additional data like import batch info
            $table->timestamps();
            
            // Composite unique index for domain and category
            $table->unique(['domain', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocked_domains');
    }
};

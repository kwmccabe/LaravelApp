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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->enum('status', [
                'active', 'forthcoming', 'out-of-stock', 'out-of-print', 'inactive'
                ])->default('inactive');
            $table->string('slug');

            $table->string('isbn');
            $table->date('publish_date')->nullable();
            $table->integer('pages')->unsigned()->default(0);

            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();       // created_at, updated_at
            $table->comment('base table');

            $table->index('status');
            $table->unique('slug');
            $table->unique('isbn');
            $table->index('publish_date');
            $table->index(['title', 'subtitle']);
            $table->fullText('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

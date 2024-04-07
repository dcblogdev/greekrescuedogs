<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDogsTable extends Migration
{
    public function up(): void
    {
        Schema::create('dogs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('sex')->nullable();
            $table->string('weight')->nullable();
            $table->date('dob')->nullable();
            $table->boolean('vaccinated')->default(true);
            $table->boolean('micro_chipped')->default(true);
            $table->boolean('sprayed')->default(true);
            $table->text('tags')->nullable();
            $table->text('key_features')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('slug');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dogs');
    }
}

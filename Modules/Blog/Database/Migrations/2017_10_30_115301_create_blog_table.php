<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->uuid('author_id');
            $table->text('description')->nullable();
            $table->text('key_features')->nullable();
            $table->text('personality')->nullable();
            $table->text('content')->nullable();
            $table->datetime('display_at');
            $table->string('shortlink')->nullable();
            $table->string('download')->nullable();
            $table->string('demo')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('slug');
            $table->index('display_at');
            $table->index('created_at');
        });

        if (env('APP_ENV') !== 'testing') {
            // DB::statement('ALTER TABLE blog_posts ADD FULLTEXT (title)');
        }
    }

    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}

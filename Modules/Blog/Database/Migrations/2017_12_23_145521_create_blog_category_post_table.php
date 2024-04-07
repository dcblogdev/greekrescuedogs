<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoryPostTable extends Migration
{
    public function up()
    {
        Schema::create('blog_category_post', function (Blueprint $table) {
            $table->uuid('category_id');
            $table->uuid('post_id');
            $table->primary(['category_id', 'post_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_category_post');
    }
}

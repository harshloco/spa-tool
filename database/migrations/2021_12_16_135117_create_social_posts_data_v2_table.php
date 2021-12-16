<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialPostsDataV2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_posts_data_v2', function (Blueprint $table) {
            $table->id();
            $table->string('postUrl')->default('');
            $table->string('profileUrl')->default('');
            $table->string('fullName')->default('');
            $table->string('title')->default('');
            $table->string('postDate')->default('');
            $table->text('textContent');
            $table->integer('likeCount')->default(0);
            $table->integer('commentCount')->default(0);
            $table->string('name')->default('');
            $table->string('query')->default('');
            $table->string('category')->default('');
            $table->timestamp('timestamp')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_posts_data_v2');
    }
}

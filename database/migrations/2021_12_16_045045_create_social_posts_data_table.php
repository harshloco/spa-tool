<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialPostsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_posts_data', function (Blueprint $table) {
            $table->id();
            $table->text('postUrl');
            $table->text('profileUrl');
            $table->string('fullName');
            $table->text('title');
            $table->string('postDate');
            $table->text('textContent');
            $table->integer('likeCount');
            $table->integer('commentCount');
            $table->string('name');
            $table->string('query');
            $table->string('category');
            $table->timestampsTz('timestamp');
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
        Schema::dropIfExists('social_posts_data');
    }
}

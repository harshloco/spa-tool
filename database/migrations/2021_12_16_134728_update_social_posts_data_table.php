<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSocialPostsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('Alter table social_posts_data RENAME TO social_posts_data_old');
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::statement('Alter table social_posts_data_old RENAME TO social_posts_data');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosterCommentRepliesMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poster_comment_replies', function (Blueprint $table) {
            $table->id();
            $table->string('poster_id', 6);
            $table->string('comment_id', 6);
            $table->string('name', 180);
            $table->string('email', 180);
            $table->text('comment');
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
        Schema::dropIfExists('poster_comment_replies');
    }
}

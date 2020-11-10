<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostersMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->string('poster_title');
            $table->string('poster_authors');
            $table->text('author_affiliations');
            $table->integer('poster_category');
            $table->string('poster_filename');
            $table->text('poster_abstract')->nullable()->default(null);
            $table->string('poster_keywords')->nullable()->default(null);
            $table->integer('total_likes')->default(0);
            $table->integer('total_dislikes')->default(0);
            $table->integer('total_comments')->default(0);
            $table->string('posted_by_id');
            $table->string('posted_by_name');
            $table->string('posted_by_email');
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
        Schema::dropIfExists('posters');
    }
}

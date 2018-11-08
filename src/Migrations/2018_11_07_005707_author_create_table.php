<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Tresa02\Medline\Model\Author;

class AuthorCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Author::TABLE, function (Blueprint $table) {
            $table->increments(Author::ID);
            $table->string(Author::FIRST_NAME);
            $table->string(Author::MIDDLE_NAME);
            $table->string(Author::LAST_NAME);
            $table->text(Author::AFFILIATIONS);
            $table->string(Author::EMAIL, 100)->unique();
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
        Schema::dropIfExists(Author::TABLE);
    }
}

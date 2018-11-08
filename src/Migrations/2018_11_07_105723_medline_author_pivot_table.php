<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Tresa02\Medline\Model\MedlineAuthor;

class MedlineAuthorPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(MedlineAuthor::TABLE, function (Blueprint $table) {
            $table->increments(MedlineAuthor::ID);
            $table->unsignedInteger(MedlineAuthor::AUTHOR_ID);
            $table->unsignedInteger(MedlineAuthor::MEDLINE_ID);
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
        Schema::dropIfExists(MedlineAuthor::TABLE);
    }
}

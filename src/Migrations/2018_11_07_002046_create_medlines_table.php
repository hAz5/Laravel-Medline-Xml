<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Tresa02\Medline\Model\Medline;

class CreateMedlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Medline::TABLE, function (Blueprint $table) {
            $table->increments(Medline::ID);
            $table->integer(Medline::DOCUMENT_ID);
            $table->string(Medline::TYPE);
            $table->string(Medline::TITLE);
            $table->string(Medline::LANG);
            $table->text(Medline::ABSTRACT);
            $table->string(Medline::DOI)->nullable();
            $table->string(Medline::COI)->nullable();
            $table->timestamp(Medline::EPUB_DATE)->useCurrent();
            $table->timestamp(Medline::PPUB_DATE)->useCurrent();
            $table->timestamp(Medline::ACCEPTED_DATE)->useCurrent();
            $table->timestamp(Medline::RECEIVED_DATE)->useCurrent();
            $table->integer(Medline::FIRST_PAGE);
            $table->integer(Medline::LAST_PAGE);
            $table->string(Medline::VOLUME);
            $table->string(Medline::ISSUE);
            $table->string(Medline::JOURNAL_TITLE);
            $table->string(Medline::KEYWORDS);
            $table->text(Medline::LATEST_XML);
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
        Schema::dropIfExists(Medline::TABLE);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChurchQuestionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('church_questions', function (Blueprint $table) {
      $table->id();
      $table->unsignedInteger('church_id')->index();
      $table->unsignedInteger('question_id')->index();
      $table->unsignedinteger('survey_id')->index();
      $table->decimal('average_rating')->default(0.0);
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
    Schema::dropIfExists('church_questions');
  }
}

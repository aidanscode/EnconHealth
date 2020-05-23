<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('response_types', function(Blueprint $table) {
      $table->id();
      $table->string('name');
    });

    Schema::create('responses', function(Blueprint $table) {
      $table->id();
      $table->foreignId('user_id');
      $table->foreignId('response_type_id');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('response_types');
    Schema::dropIfExists('responses');
  }

}

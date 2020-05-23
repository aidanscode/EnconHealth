<?php

use Illuminate\Database\Seeder;

use App\Models\ResponseType;

class ResponseTypesSeeder extends Seeder {

  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run() {
    ResponseType::updateOrCreate(['id' => ResponseType::POSITIVE], [
      'name' => 'Healthy'
    ]);

    ResponseType::updateOrCreate(['id' => ResponseType::NEGATIVE], [
      'name' => 'Not Healthy'
    ]);
  }

}

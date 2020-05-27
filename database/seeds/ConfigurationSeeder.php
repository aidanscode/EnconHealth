<?php

use Illuminate\Database\Seeder;

use App\Models\Configuration;

class ConfigurationSeeder extends Seeder {

  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run() {
    Configuration::set(Configuration::KEY_AGREEMENT_TEXT, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Morbi tincidunt augue interdum velit euismod in pellentesque. Eget nulla facilisi etiam dignissim diam quis enim lobortis. Integer feugiat scelerisque varius morbi enim nunc faucibus.');
    Configuration::set(Configuration::KEY_SEND_DAILY_EMAIL, '1');
    Configuration::set(Configuration::KEY_SEND_DAILY_EMAIL_ON_WEEKENDS, '0');
  }

}

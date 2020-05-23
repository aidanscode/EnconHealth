<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model {

  protected $table = 'configuration';
  protected $primaryKey = 'key';
  public $incrementing = false;
  protected $keyType = 'string';
  public $timestamps = false;

  protected $fillable = ['key', 'value'];

  const KEY_AGREEMENT_TEXT = 'agreement_text';
  const KEY_SEND_DAILY_EMAIL = 'send_daily_email';

  public static function getString($key, $default = null) {
    $configOption = self::find($key);

    return isset($configOption) ? $configOption->value : $default;
  }

  public static function getBoolean($key, $default = null) {
    $value = self::getString($key);

    return isset($value) ? (bool) $value : $default;
  }

  public static function set($key, $value) {
    self::updateOrCreate(['key' => $key], [
      'value' => $value
    ]);
  }

}

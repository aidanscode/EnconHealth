<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponseType extends Model {

  public static function getPositiveResponseType() {
    return self::find(ResponseType::POSITIVE);
  }

  public static function getNegativeResponseType() {
    return self::find(ResponseType::NEGATIVE);
  }

  const POSITIVE = 1;
  const NEGATIVE = 2;

  public $timestamps = false;

}

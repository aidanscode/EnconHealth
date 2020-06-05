<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailList extends Model {

  protected $table = 'email_list';
  public $timestamps = false;

  public static function getEmailList() {
    return self::all()->pluck('email');
  }

  public static function addIfNotExists($email) {
    $list = self::getEmailList();
    if (!$list->contains($email)) {
      self::insert(['email' => $email]);
    }
  }

  public static function removeIfExists($email) {
    self::where('email', $email)->delete();
  }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailList extends Model {

  protected $table = 'email_list';
  public $timestamps = false;

  public static function updateEmailList($newList) {
    $newList = collect($newList);

    //Step 1. Remove any email from the official list that is not on the new list
    self::whereNotIn('email', $newList)->delete();

    //Step 2. Add any emails not already in the official list
    $currentList = self::getEmailList();
    $newEmails = $newList->diff($currentList)->all();

    //Step 2.5: Add all emails into subarrays of format ['email' => $val] so that we can add all the new emails in one query
    $payload = [];
    foreach($newEmails as $newEmail) {
      $payload[] = ['email' => $newEmail];
    }

    self::insert($payload);
  }

  public static function getEmailList() {
    return self::all()->pluck('email');
  }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model {

  //The attributes that should be cast to native types.
  protected $casts = [
    'created_at' => 'datetime'
  ];

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function getFriendlyCreatedAtTime() {
    return $this->created_at->format('g:i A');
  }

}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\ResponseType;

class ResponseReport extends Mailable {

  use Queueable, SerializesModels;

  public $positiveType;
  public $negativeType;
  public $users;
  public $date;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($users) {
    $this->positiveType = ResponseType::getPositiveResponseType();
    $this->negativeType = ResponseType::getNegativeResponseType();

    $this->date = date('Y-m-d');
    $this->users = $users;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build() {
    return $this->subject('Health Response Report for ' . $this->date)
                ->view('mail.response_report')
                ->text('mail.response_report_plain');
  }

}

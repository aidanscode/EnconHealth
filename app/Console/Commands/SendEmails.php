<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

use App\Models\Configuration;
use App\Models\EmailList;
use App\Models\User;

use App\Mail\ResponseReport;

class SendEmails extends Command {

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'sendemails';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Send an email to everyone on the email list with a report of the responses for that day';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle() {
    if ($this->shouldSendEmailToday()) {
      $users = User::getSortedUsersByDaysResponses(date('Y-m-d'));
      $emailList = EmailList::getEmailList();
      $mail = new ResponseReport($users);

      foreach($emailList as $email) {
        echo "Sending health response report to " . $email . "\n";
        Mail::to($email)->send($mail);
      }
      echo "Sent all health response reports!\n";
    } else {
      echo "Not sending emails today";
    }
  }

  private function shouldSendEmailToday() {
    $emailsEnabled = Configuration::getBoolean(Configuration::KEY_SEND_DAILY_EMAIL);
    if (!$emailsEnabled)
      return false;

    $enabledOnWeekends = Configuration::getBoolean(Configuration::KEY_SEND_DAILY_EMAIL_ON_WEEKENDS);
    if ($enabledOnWeekends)
      return true;

    $today = date('l');
    $weekendDays = ['Saturday', 'Sunday'];
    return !in_array($today, $weekendDays);
  }

}

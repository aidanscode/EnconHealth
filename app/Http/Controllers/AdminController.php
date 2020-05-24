<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Configuration;
use App\Models\EmailList;

class AdminController extends Controller {

  public function index() {
    return view('admin.index');
  }

  public function configure() {
    $agreementText = Configuration::getString(Configuration::KEY_AGREEMENT_TEXT);
    $dailyEmailEnabled = Configuration::getBoolean(Configuration::KEY_SEND_DAILY_EMAIL);

    $emailList = EmailList::all()->pluck('email')->all();

    return view('admin.configure', [
      'agreementText' => $agreementText,
      'agreementTextKey' => Configuration::KEY_AGREEMENT_TEXT,
      'dailyEmailEnabled' => $dailyEmailEnabled,
      'dailyEmailEnabledKey' => Configuration::KEY_SEND_DAILY_EMAIL,
      'emailList' => $emailList
    ]);
  }

  public function updateConfiguration(Request $request) {
    $request->validate([
      'key' => 'required|string|exists:configuration,key',
      'value' => 'required_unless:key,' . Configuration::KEY_SEND_DAILY_EMAIL . '|string'
    ]);

    $key = $request->input('key');
    $value = $request->input('value', '0');
    Configuration::set($key, $value);

    return redirect(route('admin.configure'))->with('status', 'Successfully updated the configuration!');
  }

  public function updateEmailList(Request $request) {
    $request->validate([
      'emails' => 'array'
    ]);

    $newEmails = $request->input('emails');
    EmailList::updateEmailList($newEmails);

    return redirect(route('admin.configure'))->with('status', 'Successfully updated email list!');
  }

  public function admins() {
    return 'admins';
  }

}

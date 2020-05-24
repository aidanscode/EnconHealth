<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Configuration;
use App\Models\ResponseType;
use App\Models\EmailList;
use App\Models\User;

use Carbon\Carbon;

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

  public function byDay(Request $request) {
    if ($request->ajax()) {
      $date = $request->input('date');

      return response()->json($this->byDayFetch($date));
    }

    $positiveType = ResponseType::getPositiveResponseType();
    $negativeType = ResponseType::getNegativeResponseType();
    return view('admin.responses_by_day', [
      'positiveType' => $positiveType,
      'negativeType' => $negativeType
    ]);
  }

  public function byDayFetch($date) {
    if ($date != null) {
      try {
        $date = Carbon::parse($date)->format('Y-m-d');
      } catch(\Exception $e) {
        $date = null;
      }
    }

    //Either we failed to parse the input or $date was nul to begin with
    if ($date == null) {
      $date = Carbon::now()->format('Y-m-d');
    }

    $users = User::with(['response' => function($query) use ($date) {
      $query->whereDate('created_at', $date);
    }])->get();

    $results = [
      'positive' => [],
      'negative' => [],
      'no_response' => []
    ];

    foreach($users as $user) {
      $key = $user->response == null ? 'no_response' : ($user->response->response_type_id == ResponseType::POSITIVE ? 'positive' : 'negative');

      $results[$key][] = [
        'name' => $user->full_name,
        'email' => $user->email,
        'created_at' => $user->response == null ? null : $user->response->getFriendlyCreatedAtTime()
      ];
    }

    return $results;
  }

  public function admins() {
    return 'admins';
  }

}

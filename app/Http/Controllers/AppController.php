<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResponseType;
use App\Models\Configuration;
use Auth;

class AppController extends Controller {

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index() {
    $alreadyRespondedToday = Auth::user()->hasRespondedToday();

    if ($alreadyRespondedToday) {
      return view('app.already_responded');
    } else {
      $positiveType = ResponseType::getPositiveResponseType();
      $negativeType = ResponseType::getNegativeResponseType();
      $agreementText = Configuration::getString(Configuration::KEY_AGREEMENT_TEXT);

      return view('app.poll_response', [
        'positiveType' => $positiveType,
        'negativeType' => $negativeType,
        'agreementText' => $agreementText
      ]);
    }
  }

  public function submitResponse(Request $request) {
    $user = Auth::user();
    $alreadyRespondedToday = $user->hasRespondedToday();
    $successMessage = 'Thank you for submitting your response!';

    if ($alreadyRespondedToday) {
      //They already submitted today and manually submitted another response anyway
      //Pretend we logged it and return
      return redirect(route('index'))->with('status', $successMessage);
    }

    //This validation will always pass as long as the user wasn't messing with the html before they submitted
    $request->validate([
      'response' => 'required|exists:response_types,id'
    ]);
    $user->logTodaysResponse($request->input('response'));

    return redirect(route('index'))->with('status', $successMessage);
  }

}

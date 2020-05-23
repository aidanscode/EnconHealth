<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsAllowedEmailDomain implements Rule {

  protected $allowedDomain = 'enconmech.com';

  protected $exceptions = [
    'amurphey7@gmail.com'
  ];

  /**
   * Determine if the validation rule passes.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value) {
    $domain = substr(strrchr($value, "@"), 1);

    return $domain == $this->allowedDomain || in_array($value, $this->exceptions);
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message() {

    return 'We appreciate your interest in joining, however at the moment we only offer this service to those with "' . $this->allowedDomain . '" email addresses.';
  }

}

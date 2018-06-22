<?php
/**
 * Created by PhpStorm.
 * User: weronikakrzynowek
 * Date: 19.06.18
 * Time: 09:51
 */

namespace App\Constraints;

use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\ConstraintsValidator;

class Validation extends ConstraintsValidator
{
    const NAME_PATTERN = "/^[a-zA-Z]*$/";
    const PASSWORD_PATTERN = "/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/";

    protected $errorMessages = array();
    protected $formValues = [];

    public function validateNotEmpty($val, $key)
    {
        if (empty($val)) {
            $this->errorMessages[$key] = 'enter require data';
        }
    }

    public function validateName($val, $key)
    {
        if (!preg_match_all(self::NAME_PATTERN, $val)) {
            $this->errorMessages[$key] = 'letters and white space allowed';
        }
    }

    public function validPassword($val, $key)
    {
        if (!preg_match_all(self::PASSWORD_PATTERN, $val)) {
            $this->errorMessages[$key] = 'enter correct password';
        }
    }

    public function validateMatchPassword($input, $match, $key)
    {
        if ($input !== $match) {
            $this->errorMessages[$key] = 'password does not mach';
        }
    }

    public function validateEmail($input, $key)
    {
        if (false === filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $this->errorMessages[$key] = 'invalid email format';
        }
    }

    public function validateChecked($val, $key)
    {
        if ($val === 0) {
            $this->errorMessages[$key] = 'User agreement must be accepted';
        }
    }

    public function getErrorMessages()
    {
        return $this->errorMessages;
    }
}
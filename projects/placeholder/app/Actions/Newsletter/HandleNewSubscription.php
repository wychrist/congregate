<?php

namespace App\Actions\Newsletter;

use Illuminate\Support\Facades\Validator;
use Modules\CongregateEmailValidator\EmailValidator;
use Modules\CongregateEmailValidator\ValidatorResult;

/**
 * Handles a new Newsletter subscription
 */
class HandleNewSubscription
{


    /**
     * Handles a new Newsletter subscription
     *
     * Validates data and passes it on to the email validator
     *
     * @param string $email
     * @param integer $userId default 0
     *
     * @return array ['token' => string , 'url' => string ]
     */
    public function __invoke(string $email, int $userId = 0): ValidatorResult
    {
       $data = Validator::make(['email' => $email, 'user_id' => $userId], [
            'email' => ['required', 'string', 'email', 'max:255'],
            'user_id' => ['integer'],
        ])->validate();

        ['email' => $email] = $data;

        $result = EmailValidator::register($email, [AddSubscriber::class, 'execute'], $data);

        return $result;
    }
}

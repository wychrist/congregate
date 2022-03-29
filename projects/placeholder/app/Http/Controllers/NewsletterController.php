<?php

namespace App\Http\Controllers;

use App\Actions\Newsletter\HandleNewSubscription;
use App\Actions\Newsletter\SendSubscriptionValidationEmail;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{

    /**
     * Handle posted data
     */
    public function handleAction(Request $request, HandleNewSubscription $handler, SendSubscriptionValidationEmail $sendEmail)
    {
        $data = $request->post();

        ['email' => $email] = $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $result = $handler($email, $request->user()? $request->user()->id: 0);
        $sendEmail($result, $data);


        $message = __('app.subscription_confirm');

        if($request->isJson()) {
            return [
                'success' => true,
                'message' => $message
            ];
        }

        return back()->with('success', $message);
    }
}
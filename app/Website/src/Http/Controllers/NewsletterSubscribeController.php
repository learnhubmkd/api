<?php

namespace App\Website\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Knuckles\Scribe\Attributes\Endpoint;
use Spatie\MailcoachSdk\Facades\Mailcoach;
use App\Website\Http\Requests\SubscribeRequest;

class NewsletterSubscribeController extends Controller
{
    #[Endpoint('Website/Subscribe', <<<'DESC'
  This endpoint is for subscribing to Leanhub.mk.
  Additionally it uses Cloudflare Turnstile ReCaptcha for validation.
 DESC)]
    public function store(SubscribeRequest $request) {

        $first_name = $request->input('first_name');
        $email = $request->input('email');

        $subscriber = Mailcoach::createSubscriber(
            emailListUuid: '<email-list-uuid>',
            attributes: [
                'email' => $email,
                'first_name' => $first_name,
        ]);

        return response()->json(["message" => "Successful subcription"], 200);
    }
}

<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter {
    public function __construct(protected ApiClient $client)
    {
        //
    }


    public function subscribe(String $email, string $list = null) {
        // ??= is a null safe operator. if what's on the left is null, make it equal what's on the right
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->addListMember($list, [
            'email_address' => request('email'),
            'status' => 'subscribed'
        ]);
    }
}

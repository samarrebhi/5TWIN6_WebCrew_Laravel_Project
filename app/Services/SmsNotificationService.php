<?php

namespace App\Services;

use Twilio\Rest\Client;

class SmsNotificationService
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $this->client = new Client(config('TWILIO_SID'), config('TWILIO_TOKEN'));
        $this->from = config('TWILIO_FROM');
    }

    public function sendSms($to, $message)
    {
        return $this->client->messages->create($to, [
            'from' => $this->from,
            'body' => $message,
        ]);
    }
}

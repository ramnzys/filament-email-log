<?php

namespace Ramnzys\FilamentEmailLog\Listeners;

use Illuminate\Mail\Events\MessageSent;
use Ramnzys\FilamentEmailLog\Models\Email;

class FilamentEmailLogger
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        $email = $event->message;

        ray()->clearAll();
        ray($email->getHtmlBody());

        Email::create([
            'from' => $this->RecipientsToString($email->getFrom()),
            'to' => $this->RecipientsToString($email->getTo()),
            'cc' => $this->RecipientsToString($email->getCc()),
            'bcc' => $this->RecipientsToString($email->getBcc()),
            'subject' => $email->getSubject(),
            'html_body' => $email->getHtmlBody(),
            'text_body' => $email->getTextBody(),
            //     //'body' => 'el body...',
        ]);
    }

    private function RecipientsToString(array $recipients): ?string
    {
        return implode(
            ",",
            array_map(function ($email) {
                return "{$email->getAddress()}" . ($email->getName() ? " <{$email->getName()}>" : "");
            }, $recipients)
        );
    }
}

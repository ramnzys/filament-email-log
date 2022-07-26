<?php

namespace Ramnzys\FilamentEmailLog\Listeners;

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
    public function handle($event)
    {
        $rawMessage = $event->sent->getSymfonySentMessage();
        $email = $event->message;

        Email::create([
            'from' => $this->RecipientsToString($email->getFrom()),
            'to' => $this->RecipientsToString($email->getTo()),
            'cc' => $this->RecipientsToString($email->getCc()),
            'bcc' => $this->RecipientsToString($email->getBcc()),
            'subject' => $email->getSubject(),
            'html_body' => $email->getHtmlBody(),
            'text_body' => $email->getTextBody(),
            'raw_body' => $rawMessage->getMessage()->toString(),
            'sent_debug_info' => $rawMessage->getDebug(),
        ]);
    }

    private function RecipientsToString(array $recipients): string
    {
        return implode(
            ',',
            array_map(function ($email) {
                return "{$email->getAddress()}".($email->getName() ? " <{$email->getName()}>" : '');
            }, $recipients)
        );
    }
}

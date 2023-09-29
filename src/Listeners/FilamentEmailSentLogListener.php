<?php

namespace Magarrent\FilamentEmailSentLogViewer\Listeners;

use Illuminate\Mail\Events\MessageSent;

class FilamentEmailSentLogListener
{

    /**
     * Handle the actual logging.
     *
     * @param MessageSent $event
     * @return void
     */
    public function handle(MessageSent $event): void
    {
        $message = $event->message;

        dd($message);

        DB::table('email_log')->insert([
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'from' => $this->formatAddressField($message, 'From'),
            'to' => $this->formatAddressField($message, 'To'),
            'cc' => $this->formatAddressField($message, 'Cc'),
            'bcc' => $this->formatAddressField($message, 'Bcc'),
            'subject' => $message->getSubject(),
            'body' => $message->getBody()->bodyToString(),
            'headers' => $message->getHeaders()->toString(),
            'attachments' => $this->saveAttachments($message),
        ]);
    }

}

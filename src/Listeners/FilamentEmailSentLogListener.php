<?php

namespace Magarrent\FilamentEmailSentLogViewer\Listeners;

use Carbon\Carbon;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Log;
use Magarrent\FilamentEmailSentLogViewer\Models\EmailSentLog;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;

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

        try {
            \DB::table('email_sent_log_viewer_table')->insert([
                'sent_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'from' => $this->formatAddressField($message, 'From'),
                'to' => $this->formatAddressField($message, 'To'),
                'cc' => $this->formatAddressField($message, 'Cc'),
                'bcc' => $this->formatAddressField($message, 'Bcc'),
                'subject' => $message->getSubject(),
                'body' => $message->getBody()->toString(),
                'headers' => $message->getHeaders()->toString(),
                'attachments' => $this->saveAttachments($message),
            ]);
        } catch (\Exception $e) {
            Log::warning('FilamentEmailSentLogViewer Package => Could not log email sent: ' . $e->getMessage());
        }
    }

    /**
     * Format address strings for sender, to, cc, bcc.
     *
     * @param Email $message
     * @param string $field
     * @return null|string
     */
    function formatAddressField(Email $message, string $field): ?string
    {
        $headers = $message->getHeaders();

        return $headers->get($field)?->getBodyAsString();
    }

    /**
     * Collect all attachments and format them as strings.
     *
     * @param Email $message
     * @return string|null
     */
    protected function saveAttachments(Email $message): ?string
    {
        if (empty($message->getAttachments())) {
            return null;
        }

        return collect($message->getAttachments())
            ->map(fn(DataPart $part) => $part->toString())
            ->implode("\n\n");
    }

}

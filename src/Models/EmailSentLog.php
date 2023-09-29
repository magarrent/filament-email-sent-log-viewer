<?php

namespace Magarrent\FilamentEmailSentLogViewer\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSentLog extends Model
{
    protected $table = 'email_sent_log_viewer_table';

    protected $fillable = [
        'sent_at',
        'from',
        'to',
        'cc',
        'bcc',
        'subject',
        'body',
        'headers',
        'attachments',
    ];
}

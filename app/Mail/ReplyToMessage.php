<?php

namespace Urban\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyToMessage extends Mailable {
    use Queueable, SerializesModels;

    protected $bundle;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bundle) {
        $this->bundle = $bundle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@urban.com')
                    ->markdown('emails.replies.reply')
                    ->with([
                        'message' => $this->bundle['message'],
                        'to' => $this->bundle['user_name']
                    ]);
    }
}

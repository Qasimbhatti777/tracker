<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class caseTrackerUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $updatedTrackers;

    public function __construct($updatedTrackers)
    {
        $this->updatedTrackers = $updatedTrackers;
    }


    public function build()
    {
        return $this->subject('Case Tracker ')
            ->view('emails.caseTrackerUpdate')
            ->with(['tracker' => $this->updatedTrackers]);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailGroupremoved extends Mailable
{
    protected $user;
    protected $group;
    protected $owner;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $group, $owner)
    {
        $this->user = $user;
        $this->group = $group;
        $this->owner = $owner;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.groupremoved')->with([
            'group' => $this->group,
            'owner' => $this->owner,
        ])->subject('Participatiescan: Verwijderd uit de group ' . $this->group->title);
    }
}

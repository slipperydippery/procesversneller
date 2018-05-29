<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailGrouprequest extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $group;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $group)
    {
        $this->user = $user;
        $this->group = $group;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.grouprequest')->with([
            'group_title' => $this->group->title,
            'user' => $this->user
        ])->subject('Participatiescan: ' . $this->user->name . ' wil mee doen aan jouw groep ' . $this->group->title);
    }
}

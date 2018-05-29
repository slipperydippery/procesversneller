<?php

namespace App\Jobs;

use Mail;
use Illuminate\Bus\Queueable;
use App\Mail\EmailGroupremoved;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendGroupremovedEmail implements ShouldQueue
{
    protected $user;
    protected $group;
    protected $owner;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $group, $owner)
    {
        //
        $this->user = $user;
        $this->group = $group;
        $this->owner = $owner;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new EmailGroupremoved($this->user, $this->group, $this->owner);
        Mail::to($this->user->email)->send($email);
    }
}

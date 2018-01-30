<?php

namespace App\Mail;

use App\Teacher;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeTeacher extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $teacher;

    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Teacher $teacher, string $password)
    {


        $this->teacher = $teacher;

        $this->password = $password;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.welcome-teacher')

                    ->bcc('ent@clairefontaine.ci')

                    ->subject('Bienvenue ' . $this->teacher->fullName());
    }
}

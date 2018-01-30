<?php

namespace App\Mail;

use App\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Welcome extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $student;


    public $password;


    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(Student $student, string $password)
    {


        $this->student = $student;

        $this->password = $password;


    }



    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {


        return $this->markdown('emails.welcome')

                    ->bcc('ent@clairefontaine.ci')

                    ->subject('Bienvenue ' . $this->student->fullName());


    }
}

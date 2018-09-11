<?php

namespace App\Notifications;

use App\Channels\Message\Sms;
use App\Channels\MtnSmsProChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StudentCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var
     *
     * Student to send notification to
     */
    protected $student;

    /**
     * @var
     *
     * Student password
     */

    protected $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $student, $password )
    {


        $this->student = $student;

        $this->password = $password;


    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $this->student
     * @return array
     */
    public function via($notifiable)
    {


        return [MtnSmsProChannel::class];


    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $this->student
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $this->student
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * @param $notifiable
     * @return Sms
     */
    public function toSmsPro($notifiable)
    {


        return (new Sms())

            ->recipientStudent( $this->student )
            ->body('L\'inscription de ' . urlencode($this->student->firstname) .
                ' a bien ete effectuee. Vous trouverez ci-dessous ses identifiants de connexion a la plateforme ' .
                'Clairefontaine ENT : ' . '%0ALogin : ' . $this->student->username . '%0AMot de passe : ' . $this->password .
                '%0ARendez-vous sur ' . url( '/' ) )
            ->originator(config('smspro.originator2'));


    }
}

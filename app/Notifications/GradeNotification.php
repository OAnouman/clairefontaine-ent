<?php

namespace App\Notifications;

use App\Channels\Message\Sms;
use App\Channels\MtnSmsProChannel;
use App\Grade;
use App\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class GradeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $grade;

    protected $student;

    protected $bccAddress = 'ent@clairefontaine.ci';


    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct(Grade $grade, Student $student)
    {


        $this->grade = $grade;

        $this->student = $student;


    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function via($notifiable)
    {
        return [MtnSmsProChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
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
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }


    public function toSmsPro($notifiable)
    {


        return (new Sms)

                ->recipientStudent($this->student)

                ->body('Cher parent, ' . $this->student->firstname . ' a une nouvelle evaluation en ' .
                    urlencode($this->grade->evaluation->subject->name) . ' avec la note de ' . $this->grade->value . '.%0A' .
                    'Pour plus d\'informations rendez-vous sur '  . url('/') . '.')

                ->originator(env('MTN_ORIGINATOR_1'));


    }


}

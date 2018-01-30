<?php

namespace App\Notifications;

use App\Message;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MessageReceivedNotification extends Notification implements ShouldQueue
{

    use Queueable;

    protected $message;

    protected $user;

    protected $bccAddress = 'ent@clairefontaine.ci';


    /**
     * Create a new notification instance.
     *
     * @param Message $message
     *
     * @param User $user
     *
     * @internal param $
     *
     */

    public function __construct(Message $message, User $user)
    {


        $this->message = $message;

        $this->user = $user;


    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function via($notifiable)
    {


        return ['mail'];


    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toMail($notifiable)
    {


        if ($this->user->userable instanceof \App\Teacher)


            return (new MailMessage)

                ->bcc($this->bccAddress)

                ->subject('Nouveau message de ' . $this->message->originatorUser->userable->fullName() . ' (Parent)' )

                ->greeting('Bonjour '. $this->message->recipientUser->userable->fullName() .',')

                ->line('Vous avez reçu un nouveau message de ' . $this->message->originatorUser->userable->fullName() . ' (Parent).')

                ->line('Vous pouvez le lire et y répondre en cliquant sur le bouton ci-dessous.')

                ->action('Répondre', route('message_center.show', $this->message->message_thread_id) )

                ->salutation('L\'équipe Clairefontaine ENT' );

        else


            return (new MailMessage)

                ->bcc($this->bccAddress)

                ->subject('Nouveau message de ' . $this->message->originatorUser->userable->fullName() )

                ->greeting('Bonjour,')

                ->line('Vous avez reçu un nouveau message de ' . $this->message->originatorUser->userable->fullName() . '.' )

                ->line('Vous pouvez le lire et y répondre en cliquant sur le bouton ci-dessous.')

                ->action('Répondre', route('message_center_parent.show', $this->message->message_thread_id))

                ->salutation('L\'équipe Clairefontaine ENT' );


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
}

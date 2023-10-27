<?php

namespace App\Notifications\Retrait;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRetraitNotificationClient extends Notification
{
  use Queueable;


  protected $data;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($data)
  {
    $this->data = $data;
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
    return (new MailMessage)
      ->subject("Demande de retrait")
      ->greeting("Bonjour")
      ->line('Vous venez d\'effectuer une demande de retrait de commission depuis votre compte EHMW Assurance.')
      ->line('Montant : ' . $this->data['montant'])
      ->line('Motif : ' . $this->data['motif'])
      ->line('Votre demande est prise en compte et sera traitée au plus tot.')
      ->action('Details du retrait', route('retraits.show', $this->data['id']));
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

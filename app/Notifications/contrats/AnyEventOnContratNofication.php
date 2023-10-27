<?php

namespace App\Notifications\contrats;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AnyEventOnContratNofication extends Notification
{
  use Queueable;
  protected $data;

  public function __construct($data)
  {
    $this->data = $data;
  }

  public function via($notifiable)
  {
    return ['mail'];
  }

  public function toMail($notifiable)
  {
    return (new MailMessage)
      ->subject($this->data['event'] . " de contrat")
      ->greeting("Bonjour")
      ->line($this->data['event'] . ' d\'un contrat sur EHMW Assurance.')
      ->line('Contrat : ' . $this->data['reference'])
      ->line('Motif : ' . $this->data['motif'])
      ->line('Utilisateur : ' . $this->data['user'])
      ->action('Details du contrat', route('contrats.show', $this->data['reference']));
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

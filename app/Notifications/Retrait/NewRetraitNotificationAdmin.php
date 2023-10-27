<?php

namespace App\Notifications\Retrait;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRetraitNotificationAdmin extends Notification
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
      ->subject("Demande de retrait")
      ->greeting("Bonjour")
      ->line('Nouvelle demande de retrait émise depuis EHMW Assurance.')
      ->line('Utilisateur : ' . $this->data['user'])
      ->line('Montant : ' . $this->data['montant'])
      ->line('Motif : ' . $this->data['motif'])
      ->action('Details du retrait', route('retraits.show', $this->data['id']));
  }

  public function toArray($notifiable)
  {
    return [
      //
    ];
  }
}

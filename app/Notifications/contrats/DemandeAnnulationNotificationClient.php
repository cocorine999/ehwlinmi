<?php

namespace App\Notifications\contrats;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandeAnnulationNotificationClient extends Notification
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
      ->subject("Demande d'annulation de contrat")
      ->greeting("Bonjour")
      ->line("Votre demande d'annulation de contrat sur EHMW Assurance sera prise en compte.")
      ->line('Contrat : ' . $this->data['reference'])
      ->line('Motif : ' . $this->data['motif'])
      ->action('Details du contrat', route('contrats.show', $this->data['reference']));
  }

  public function toArray($notifiable)
  {
    return [
      //
    ];
  }
}

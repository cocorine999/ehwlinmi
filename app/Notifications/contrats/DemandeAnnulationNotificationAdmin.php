<?php

namespace App\Notifications\contrats;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandeAnnulationNotificationAdmin extends Notification
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
      ->line("Nouvelle demande d'annulation de contrat sur EHMW Assurance.")
      ->line('Contrat : ' . $this->data['reference'])
      ->line('Motif : ' . $this->data['motif'])
      ->line('Utilisateur : ' . $this->data['user'])
      ->action('Details du contrat', route('contrats.show', $this->data['reference']));
  }

  public function toArray($notifiable)
  {
    return [
      //
    ];
  }
}

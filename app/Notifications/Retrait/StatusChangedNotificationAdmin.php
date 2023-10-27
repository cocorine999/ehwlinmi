<?php

namespace App\Notifications\Retrait;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusChangedNotificationAdmin extends Notification
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
      ->line('Demande de retrait de commission ' . $this->data['status'])
      ->line('Utilisateur : ' . $this->data['user'])
      ->line('Montant : ' . $this->data['montant'])
      ->line('Motif : ' . $this->data['motif'])
      ->line('Status : ' . $this->data['status'])
      ->line('Observation : ' . $this->data['observation'])
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

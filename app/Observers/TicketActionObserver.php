<?php

namespace App\Observers;

use App\Notifications\DataChangeEmailNotification;
use App\Notifications\AssignedTicketNotification;
use App\Models\Ticket;
use App\User;
use Illuminate\Support\Facades\Notification;

class TicketActionObserver
{
    public function created(Ticket $model)
    {
        $data  = ['action' => 'New ticket has been created!', 'model_name' => 'Ticket', 'ticket' => $model];
        $users = User::role(config('custom.roles.ITMMS'))->get();
        # Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Ticket $model)
    {
        if($model->isDirty('assigned_to_user_id'))
        {
            $user = $model->assigned_to_user;
            if($user)
            {
                # Notification::send($user, new AssignedTicketNotification($model));
            }
        }
    }
}

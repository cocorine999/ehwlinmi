<?php

namespace App\Channels;

use Illuminate\Support\Str;
use App\Models\Sms;
use App\User;
use Illuminate\Notifications\Notification;
use Auth;

class OceanicSMSChannel
{
    public function send ($notifiable, Notification $notification) {

        if (method_exists($notifiable, 'routeNotificationForOceanicSMS')) {
            $id = $notifiable->routeNotificationForOceanicSMS($notifiable);
        } else {
            $id = $notifiable->getKey();
        }
        $data = method_exists($notification, 'toOceanicSMS')
            ? $notification->toOceanicSMS($notifiable)
            : $notification->toArray($notifiable);

        if (empty($data)) {
            return;
        }

        $receiver = $data['to'];
        $message = $data['message'];

        $to = $receiver->id;
        $receiver=(string)$receiver->telephone;
        $receiver='229'.$receiver;


        // if(Str::startsWith($response->getBody(), '00229')){
        //     $replaced = Str::replaceFirst('00229', '229', $receiver);
        // }
        // else if(Str::startsWith($response->getBody(), '+229')){
        //     $replaced = Str::replaceFirst('+229', '229', $receiver);
        // }

        $api = "5617";
        $user = "ehwhlinmi";
        $password = "assurance";
        $from = "EHWLINMIAS";
        $endpoint = "http://oceanicsms.com/api/http/sendmsg.php?user=".$user."&password=".$password."&from=".$from."&to=".$receiver."&text=".$message."&api=".$api;
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $endpoint);
        $sms = Sms::create([
            'from'      => Auth::id(),
            'to'        => $to,
            'message'   => $message
        ]);

        if(Str::startsWith($response->getBody(), 'ID:')){
            $sms->update(['sent' => true, 'response' => $response->getBody()]);
            // toastr()->success('SMS envoyé au nouveau souscripteur '.$response->getBody(), 'Succès');
        }
        else if(Str::startsWith($response->getBody(), 'ERR:')){
            $sms->update(['sent' => false, 'response' => $response->getBody()]);
            // toastr()->warning('SMS non envoyé au nouveau souscripteur '.$response->getBody(), 'SMS non envoyé');
        }




        // app('log')->info(json_encode([
        //     'id'   => $id,
        //     'data' => $data,
        // ]));

        return true;

  }
}

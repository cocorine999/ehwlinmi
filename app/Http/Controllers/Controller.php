<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use App\Models\Sms;
use App\Models\MobileMoney;
use Auth;
use Session;

use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;


use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function createUserWallets($user){
        $user->createWallet([ 'name' => 'Solde Principal', 'slug' => 'principal' ]);
        $user->createWallet([ 'name' => 'Solde Commission', 'slug' => 'commission' ]);
    }

    /*
    * Add an error to Laravel session $errors
    * @author Pavel Lint
    * @param string $key
    * @param string $error_msg
    */
    protected function add_error($error_msg, $key = 'default') {
        $errors = Session::get('errors', new ViewErrorBag);
        if (! $errors instanceof ViewErrorBag) {
            $errors = new ViewErrorBag;
        }
        $bag = $errors->getBags()['default'] ?? new MessageBag;
        $bag->add($key, $error_msg);

        Session::flash(
            'errors', $errors->put('default', $bag)
        );
    }

    protected function sendSMS($message, $receiver)
    {
        $saveto = $receiver->id;
        $receiver=(string)$receiver->telephone;
        $receiver='22955028592'/* .$receiver */;
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
            'to'        => $saveto,
            'message'   => $message
        ]);

        if(Str::startsWith($response->getBody(), 'ID:')){
            $sms->update(['sent' => true, 'response' => $response->getBody()]);
            toastr()->success('SMS envoyé au nouveau souscripteur '.$response->getBody(), 'Succès');
        }
        else if(Str::startsWith($response->getBody(), 'ERR:')){
            $sms->update(['sent' => false, 'response' => $response->getBody()]);
            toastr()->warning('SMS non envoyé au nouveau souscripteur '.$response->getBody(), 'SMS non envoyé');
        }
    }

    protected function custom_paginate($items, $perPage = 100, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


}


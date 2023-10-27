<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\ContactMail;
use App\Mail\ContactFormToAdminMail;

class HomeController extends Controller
{
    public function index(){
        return view('welcome');
    }

    // public function env(){
    //     return view('env');
    // }

    public function marchands(){
        $communes = Commune::all();
        $marchands = "";
        return view('trouver_marchands',compact(['communes', 'marchands']));
    }

    public function search(Request $request){
        $communes = Commune::all();
        $marchands = User::role(config('custom.roles.marchand'))->where('commune_id', $request->commune_id)->get();
        return view('trouver_marchands',compact(['communes', 'marchands']));
    }

    public function contact(Request $request){
        $request->validate([
            "name" => 'required',
            "email" => 'required|email',
            "telephone" => 'required',
            "message" => 'required',
        ]);

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "telephone" => $request->telephone,
            "message" => $request->message,
        ];

        $admins = ["groupemmsbj@gmail.com", "branlycaele@gmail.com"];

        Mail::to("contact.ehwhlinmi@legroupemms.com")->send(new ContactFormToAdminMail($data));
        Mail::to($request->email)->send(new ContactMail());
        
        toastr()->success('Message bien envoyé.', 'Succès');
        return redirect()->back();
    }
}

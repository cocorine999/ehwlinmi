<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReglementMultipleController extends Controller
{
  public function index(Request $request)
  {
    // charger la page directement
  }

  public function valider(Request $request)
  {
    dd($request->all());
  }
}

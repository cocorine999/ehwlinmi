<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

   public function login(Request $request){

      request()->validate([
        'identifiant' => 'required',
        'password' => 'required',
      ]);

      $user = User::where(["telephone"=>$request["identifiant"]])->first();

      if($user){

        if(Hash::check($request['password'], $user['password'])){

          $credentials = ['telephone' => $request["identifiant"], 'password' => $request["password"]];

          if (Auth::attempt($credentials)) {

              return response()->json([
                  'data' => [
                      'profil' => new UserResource(request()->user()),
                      'role' => $this->checkRole($request),
                      'access_token' => Auth::user()->createToken("EHWLINMI AUTHENTICATED API TOKEN")->accessToken,
                  ]

              ],Response::HTTP_OK);

          }

          else{

              return response()->json([
                  'message' => "Echec d'authentification",
                  'errors' => [
                      'message' => ["Error d'authentification.\n Veuillez réessayer"],
                  ]
              ],Response::HTTP_UNAUTHORIZED);

          }

        }else{

            return response()->json([
                'message' => "Echec d'authentification",
                'errors' => [
                    'password' => ["Mot de passe incorrect"],
                ]
            ],Response::HTTP_UNAUTHORIZED);

        }
      }
      else{
          return response()->json([
              'message' => "Echec d'authentification",
              'errors' => [
                  'identifiant' => ["Identifiant incorrect"],
              ]
          ],Response::HTTP_UNAUTHORIZED);
      }

   }

   public function logout(Request $request){

      try{
          $accessToken=$request->user()->token();
          $accessToken->revoke();
          return response()->json(['message' => 'Vous êtes bien déconnecté'],Response::HTTP_OK);
      }
      catch(\Exception $e){
          $message = $e->getMessage();
          return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }

   }

   public function get_authenticated_user(Request $request){
        try {

          return response()->json([
            'data' => $request->user(),

          ],Response::HTTP_OK);

        } catch (\Exception $e) {
            $message = $e->getMessage();
            return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
   }

   public function getUserRoles(Request $request){

      try {

        return response()->json([
          'data' => $request->user()->roles,

        ],Response::HTTP_OK);

      } catch (\Exception $e) {
          $message = $e->getMessage();
          return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }
   }

   public function checkIfUserHasRole($role){

      try {

        if($request->user()->hasRole($role) == true){
            return response()->json([
              'data' => true,
            ],Response::HTTP_OK);
        }
        else {
          return response()->json([
            'data' => false,
          ],Response::HTTP_OK);
        }

      } catch (\Exception $e) {
          $message = $e->getMessage();
          return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }
   }

  private function checkRole(Request $request){

    if($request->user()->hasRole(config('custom.roles.direction_all_cs')) == true){
        return "direction";
    }
    elseif($request->user()->hasRole(config('custom.roles.smarchand')) == true){
      return "supermarchand";
    }
    elseif($request->user()->hasRole(config('custom.roles.marchand')) == true){
      return "marchand";
    }
    elseif($request->user()->hasRole(config('custom.roles.client')) == true){
      return "client";
    }
    else{
      return null;

    }
  }
}

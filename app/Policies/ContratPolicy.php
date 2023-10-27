<?php

namespace App\Policies;

use App\Models\Contrat;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Carbon\Carbon;

class ContratPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view any contrats.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function viewAny(User $user)
  {
    //
  }

  /**
   * Determine whether the user can view the contrat.
   *
   * @param  \App\User  $user
   * @param  \App\Contrat  $contrat
   * @return mixed
   */
  public function view(User $user, Contrat $contrat)
  {
    //
  }

  /**
   * Determine whether the user can create contrats.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user)
  {
    //
  }

  /**
   * Determine whether the user can update the contrat.
   *
   * @param  \App\User  $user
   * @param  \App\Contrat  $contrat
   * @return mixed
   */
  public function update(User $user, Contrat $contrat)
  {
    //
  }

  /**
   * Determine whether the user can delete the contrat.
   *
   * @param  \App\User  $user
   * @param  \App\Contrat  $contrat
   * @return mixed
   */
  public function delete(User $user, Contrat $contrat)
  {
    //
  }

  /**
   * Determine whether the user can restore the contrat.
   *
   * @param  \App\User  $user
   * @param  \App\Contrat  $contrat
   * @return mixed
   */
  public function restore(User $user, Contrat $contrat)
  {
    //
  }

  /**
   * Determine whether the user can permanently delete the contrat.
   *
   * @param  \App\User  $user
   * @param  \App\Contrat  $contrat
   * @return mixed
   */
  public function forceDelete(User $user, Contrat $contrat)
  {
    //
  }

  public function renouveller(User $user, Contrat $contrat)
  {
    if ($contrat->souscriptions->count() < 2 & $contrat->souscriptions->last()->primes->count() === 12 & $contrat->statut == "Terminé") {

      $date_naissance_assure = $contrat->assure->users->first()->date_naissance;

      if (Carbon::parse($date_naissance_assure)->diffInYears($contrat->date_expiration) < 74) {
        return true;
      }
    }
    return false;
  }
}

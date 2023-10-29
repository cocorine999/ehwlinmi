        <li class="nav-item has-treeview">
            <a href="{{route('dash.index')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Tableau de bord</p>
            </a>
          </li>

          @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.direction_ARH'))
          <li class="nav-item">
            <a href="{{route('utilisateurs.create')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Ajouter super-marchand</p>
            </a>
          </li>
          @endhasanyrole

          @role(config('custom.roles.direction_all'))
          <li class="nav-item">
            <a href="{{route('utilisateurs.index')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Liste Globale</p>
            </a>
          </li>
          @endrole

          @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.direction_MAC').'|'.config('custom.roles.direction_C').'|'.config('custom.roles.direction_ARH').'|'.config('custom.roles.direction_FC').'|'.config('custom.roles.ITMMS'))
          <li class="nav-item">
            <a href="{{route('contrats.all')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Liste des Contrats</p>
            </a>
          </li>
          @endhasanyrole

          @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.direction_C').'|'.config('custom.roles.direction_FC').'|'.config('custom.roles.direction_MAC'))
          <li class="nav-item">
            <a href="{{route('sinistres.index')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Sinistres</p>
            </a>
          </li>
          @endhasanyrole

          @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.direction_C').'|'.config('custom.roles.direction_FC').'|'.config('custom.roles.direction_MAC').'|'.config('custom.roles.ITMMS'))
          <li class="nav-item">
            <a href="{{route('etats.create')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Etat des primes</p>
               </a>
          </li>
          @endhasanyrole

          @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.direction_C').'|'.config('custom.roles.direction_FC').'|'.config('custom.roles.direction_MAC'))
          <li class="nav-item">
            <a href="{{route('etats.listeCommissions')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Etat des commissions</p>
               </a>
          </li>
          @endhasanyrole

          @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.direction_C').'|'.config('custom.roles.direction_ARH').'|'.config('custom.roles.direction_FC').'|'.config('custom.roles.direction_MAC').'|'.config('custom.roles.ITMMS'))
          <li class="nav-item">
            <a href="{{route('contrats.etat')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Etat des adhésions</p>
               </a>
          </li>
          @endhasanyrole

          @role(config('custom.roles.smarchand'))
          <li class="nav-item">
            <a href="{{route('utilisateurs.create')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Ajouter un marchand</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('marchands.mesmarchands')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Mes marchands</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('supermarchands.contrats')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Contrats</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('supermarchands.sinistres')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Sinistres</p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{route('etats.perso')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Etat des primes</p>
               </a>
          </li>
          @endrole


          @hasanyrole(config('custom.roles.nsia_all'))
          <li class="nav-item">
            <a href="{{route('contrats.enattente')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Contrats en attente de traitement</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('etats.create')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Etat des primes</p>
               </a>
          </li>

          <li class="nav-item">
            <a href="{{route('contrats.etat')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Etat des adhésions</p>
               </a>
          </li>

          <li class="nav-item">
            <a href="{{route('contrats.all')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Liste des Contrats</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('utilisateurs.index')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Liste Globale</p>
            </a>
          </li>
          @endrole


          @role(config('custom.roles.marchand'))
          <li class="nav-item">
            <a href="{{route('contrats.mescontrats')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Mes Contrats</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('marchands.sinistres')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Sinistres</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('contrats.create')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Ajouter un contrat</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('primes.create')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Enregistrer une prime</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('prospects.index')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Prospects</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('prospects.create')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Enregistrer un prospect</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('etats.perso')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Etat des primes</p>
               </a>
          </li>
          @endrole


          @role(config('custom.roles.client'))
          <li class="nav-item">
            <a href="{{route('contrats.mescontrats')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Mes contrats</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('primes.create')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Enregistrer une prime</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('sinistres.messinistres')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Mes sinistres</p>
            </a>
          </li>
          @endrole

          @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.ITMMS').'|'.config('custom.roles.direction_ARH'))
          <li class="nav-item">
            <a href="{{route('directions.index')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Direction</p>
            </a>
          </li>
          @endhasanyrole


          @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.direction_ARH').'|'.config('custom.roles.direction_C').'|'.config('custom.roles.ITMMS').'|'.config('custom.roles.direction_FC').'|'.config('custom.roles.direction_MAC'))
          <li class="nav-item">
            <a href="{{route('etats.liste')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Liste des Etats</p>
               </a>
          </li>
          @endhasanyrole

          @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.ITMMS').'|'.config('custom.roles.direction_FC'))
          <li class="nav-item">
            <a href="{{route('directions.point_commissions')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Point commissions</p>
               </a>
          </li>
          @endhasanyrole


          @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.direction_ARH').'|'.config('custom.roles.direction_C').'|'.config('custom.roles.ITMMS').'|'.config('custom.roles.direction_FC').'|'.config('custom.roles.direction_MAC'))
          <li class="nav-item">
            <a href="{{route('directions.point_super_marchands')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Point Super M.</p>
               </a>
          </li>
          @endhasanyrole


          <li class="nav-item">
            <a href="{{route('retraits.index')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Retrait commission</p>
               </a>
          </li>

          @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.direction_ARH').'|'.config('custom.roles.nsia').'|'.config('custom.roles.ITNSIA'))
          <li class="nav-item">
            <a href="{{route('nsia.index')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>NSIA Vie</p>
            </a>
          </li>
          @endhasanyrole


          @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.direction_C').'|'.config('custom.roles.ITMMS').'|'.config('custom.roles.direction_FC'))
          <li class="nav-item">
            <a href="{{route('transactions.index')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Transactions</p>
            </a>
          </li>
          @endhasanyrole


          @hasanyrole(config('custom.roles.direction_FC').'|'.config('custom.roles.ITMMS'))
          <!-- <li class="nav-item">
            <a href="{{route('etats.recettes')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Recettes</p>
            </a>
          </li> -->
          @endhasanyrole

          @hasanyrole(config('custom.roles.direction_ARH').'|'.config('custom.roles.ITMMS'))
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('sidebar-production-form').submit();">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Etat production</p>
            </a>
            <form autocomplete="off" id="sidebar-production-form" action="{{route('etats.production')}}" method="POST" style="display: none;"> @csrf </form>
          </li>
          @endhasanyrole


          @hasanyrole(config('custom.roles.direction_FC').'|'.config('custom.roles.ITMMS'))
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('sidebar-recettes-form').submit();">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Etat Recettes</p>
            </a>
            <form autocomplete="off" id="sidebar-recettes-form" action="{{route('etats.recettes')}}" method="POST" style="display: none;"> @csrf </form>
          </li>
          @endhasanyrole


          @hasanyrole(config('custom.roles.direction_ARH').'|'.config('custom.roles.direction_C').'|'.config('custom.roles.ITMMS'))
          <li class="nav-item">
            <a class="nav-link" href="{{route('tickets.index')}}">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Tickets <small class="badge badge-primary">{{ optional(optional(App\Models\TicketStatus::where('name', "Ouvert")->first())->tickets)->count()}} ouverts</small></p>
            </a>
          </li>
          @endhasanyrole

          <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Se déconnecter</p>
            </a>
            <form autocomplete="off" id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
          </li>


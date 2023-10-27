<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use App\Etat;
use App\Exports\Etat\EtatGlobal;
use App\Exports\Etat\EtatPrime;
use App\Exports\Etat\ProductionMSm;
use App\Exports\Etat\ProductionNsia;
use App\Exports\Etat\EtatUtilisateurs;
use App\User;
use Carbon\Carbon;
use App\Models\Assure;
use App\Models\Client;
use App\Models\Primes;
use App\Models\Contrat;
use App\Models\Sinistre;
use App\Exports\ExcelExport;
use App\Models\Souscription;
use Illuminate\Http\Request;
use App\Exports\ExcelTransfert;
use Illuminate\Support\Facades\DB;
use App\Exports\ExcelExportMarchand;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelListeCommissions;
use App\Exports\ExcelRecettes;
use App\Jobs\PrepareRecetteFile;
use App\Jobs\PrepareEtatProductionFile;
use App\Models\Departement;
use Spatie\Permission\Models\Role;

class EtatController extends Controller
{
  public $dataResult = [];

  /*  public function __construct()
  {
    return view('dash.etats.index');
  }

    $this->$data = $dataResult;
  } */

  public function list()
  {
    return view('dash.etats.index');
  }

  public function index()
  {
    $results = "";
    $moisactuel = Carbon::now()->month;
    return view('dash.etats.etats', compact(['results', 'moisactuel']));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $results = "";
    $moisactuel = Carbon::now()->month;
    return view('dash.etats.create', compact(['results', 'moisactuel']));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function listeCommissions()
  {
    $results = "";
    $moisactuel = Carbon::now()->month;
    return view('dash.etats.listeCommissions', compact(['results', 'moisactuel']));
  }

  public function recherche(Request $request)
  {

    $moisactuel = Carbon::now()->month;
    $debut = $request->date_debut;
    $fin = $request->date_fin;
    $results = DB::table('contrats')
      ->join('clients', 'contrats.client_id', '=', 'clients.id')
      ->join('assures', 'contrats.assure_id', '=', 'assures.id')
      ->join('souscriptions', 'contrats.id', '=', 'souscriptions.contrat_id')
      ->join('primes', 'souscriptions.id', '=', 'primes.souscription_id')
      ->whereBetween(DB::raw('DATE(primes.created_at)'), [$request->date_debut, $request->date_fin])
      ->select(
        'primes.*',
        'contrats.reference as reference',
        'contrats.id as idContrat',
        'clients.id as client_id',
        'primes.created_at as date',
        'assures.id as assure_id'
      )
      ->get();

    if ($request->type == 'primes') {
      /* dump($request->date_debut);
         dump($request->date_fin);
         dd($results); */
      return view('dash.etats.create', compact(['results', 'moisactuel', 'debut', 'fin']));
    } elseif ($request->type == 'commissions') {

      return view('dash.etats.listeCommissions', compact(['results', 'moisactuel', 'debut', 'fin']));
    }
  }


  public function etatPrimes(Request $request)
  {
    $moisactuel = Carbon::now()->month;
    $debut = $request->date_debut;
    $fin = $request->date_fin;

    if (Auth::user()->hasRole(config('custom.roles.marchand'))) {

      $results = DB::table('contrats')
        ->join('clients', 'contrats.client_id', '=', 'clients.id')
        ->join('assures', 'contrats.assure_id', '=', 'assures.id')
        ->join('souscriptions', 'contrats.id', '=', 'souscriptions.contrat_id')
        ->join('primes', 'souscriptions.id', '=', 'primes.souscription_id')
        ->where('souscriptions.user_id', Auth::user()->id)
        ->whereBetween(DB::raw('DATE(primes.created_at)'), [$request->date_debut, $request->date_fin])
        ->select(
          'primes.*',
          'contrats.reference as reference',
          'contrats.id as idContrat',
          'clients.id as client_id',
          'assures.id as assure_id',
          'primes.created_at as date'
        )
        ->get();
    } else {
      if (Auth::user()->super_marchand->first()->marchands != "") {
        foreach (Auth::user()->super_marchand->first()->marchands as $value) {

          $results = DB::table('contrats')
            ->join('clients', 'contrats.client_id', '=', 'clients.id')
            ->join('assures', 'contrats.assure_id', '=', 'assures.id')
            ->join('souscriptions', 'contrats.id', '=', 'souscriptions.contrat_id')
            ->join('primes', 'souscriptions.id', '=', 'primes.souscription_id')
            ->whereBetween(DB::raw('DATE(primes.created_at)'), [$request->date_debut, $request->date_fin])
            ->select(
              'primes.*',
              'contrats.reference as reference',
              'contrats.id as idContrat',
              'clients.id as client_id',
              'assures.id as assure_id'
            )
            ->get();
        }
      }
    }
    // dd($results);

    return view('dash.etats.etats', compact(['results', 'moisactuel', 'debut', 'fin']));
  }

  public function recherchecontratAttente(Request $request)
  {
    $moisactuel = Carbon::now()->month;
    $debut = $request->date_debut;
    $fin = $request->date_fin;
    $contrats = DB::table('contrats')
      ->join('clients', 'contrats.client_id', '=', 'clients.id')
      ->join('assures', 'contrats.assure_id', '=', 'assures.id')
      ->join('souscriptions', 'contrats.id', '=', 'souscriptions.contrat_id')
      ->leftJoin('primes', 'souscriptions.id', '=', 'primes.souscription_id')
      ->whereBetween('souscriptions.date_effet', [$request->date_debut, $request->date_fin])
      ->select(
        'primes.*',
        'contrats.reference as reference',
        'contrats.id as idContrat',
        'clients.id as client_id',
        'assures.id as assure_id',
        'primes.created_at as date',
        'souscriptions.*'
      )

      ->get();

    //dd($contrats);
    //Contrat::all()->load("souscriptions")->whereBetween('date_effet',[$request->date_debut, $request->date_fin]);
    return view('dash.contrats.resultat', compact(['contrats', 'moisactuel', 'debut', 'fin']));
  }

  public function rechercheHistorique(Request $request)
  {
    $user = Auth::user();
    $historiques = [];
    if ($user->hasAnyRole([config('custom.roles.direction') . '|' . config('custom.roles.nsia')])) {
      $data = DB::table('transfers')
        ->join('transactions', 'transfers.deposit_id', '=', 'transactions.id')
        ->whereBetween(DB::raw('DATE(transfers.created_at)'), [$request->date_debut, $request->date_fin])
        ->select('from_id', 'to_id', 'transfers.created_at', 'amount')
        ->get();

      foreach ($data as $key => $prime) {
        if ($prime->from_id != null && $prime->to_id != null) {
          array_push($historiques, [
            'source' => User::where('id', $prime->from_id)->first()["nom"] . ' ' . User::where('id', $prime->from_id)->first()["prenom"],
            'roleS' => User::where('id', $prime->from_id)->first() ? User::where('id', $prime->from_id)->first()->getRoleNames()[0] : '',
            'destination' => User::where('id', $prime->to_id)->first()["nom"] . ' ' . User::where('id', $prime->to_id)->first()["prenom"],
            'roleD' => User::where('id', $prime->to_id)->first() ? User::where('id', $prime->to_id)->first()->getRoleNames()[0] : '',
            'point' => $prime->amount,
            'date' => $prime->created_at,

          ]);
        }
        # code...
      }
    } elseif ($user->hasAnyRole([config('custom.roles.smarchand') . '|' . config('custom.roles.marchand')])) {

      $data = DB::table('transfers')
        ->join('transactions', 'transfers.deposit_id', '=', 'transactions.id')
        ->where('transfers.from_id', $user->id)
        ->whereBetween(DB::raw('DATE(transfers.created_at)'), [$request->date_debut, $request->date_fin])
        ->select('from_id', 'to_id', 'transfers.created_at', 'amount')
        ->get();
      // dd($data);
      foreach ($data as $key => $prime) {
        if ($prime->from_id != null && $prime->to_id != null) {
          array_push($historiques, [
            'source' => User::where('id', $prime->from_id)->first()["nom"] . ' ' . User::where('id', $prime->from_id)->first()["prenom"],
            'roleS' => User::where('id', $prime->from_id)->first() ? User::where('id', $prime->from_id)->first()->getRoleNames()[0] : '',
            'destination' => User::where('id', $prime->to_id)->first()["nom"] . ' ' . User::where('id', $prime->to_id)->first()["prenom"],
            'roleD' => User::where('id', $prime->to_id)->first() ? User::where('id', $prime->to_id)->first()->getRoleNames()[0] : '',
            'point' => $prime->amount,
            'date' => $prime->created_at,

          ]);
        }
        # code...
      }
    }
    return view('dash.comptes.resultat', compact(['historiques', 'data']));
  }

  public function exportExcelListeCommissions(Request $request)
  {
    $dataResult = $request->data;
    // dd($dataResult);
    $data = [];
    if ($dataResult != null) {
      foreach (json_decode($dataResult) as $key => $item) {
        array_push($data, [
          'N°' => ++$key,
          'Souscripteur' => Client::where('id', $item->client_id)->first()->users->first()->getFullNameAttribute(),
          'Assuré' => Assure::where('id', $item->assure_id)->first()->users->first()->getFullNameAttribute(),
          'Numéro de police'  => $item->reference,
          'Montant'  => $item->montant,
          'Prime totale Payée'  => Primes::where('souscription_id', $item->souscription_id)->get()->count(),
          'Reste à Payer' => 12 - Primes::where('souscription_id', $item->souscription_id)->get()->count(),
          'Commission Marchand' => $item->c_marchand / 10 ?? "''",
          'Commission Super-marchand' => $item->c_smarchand / 10 ?? "''",
          'Commission GMMS' => $item->c_mms / 10 ?? "''",
          'NSIA' => $item->c_nsia / 10 ?? "''",
          //'Forfait gestion administrative' => $item->c_marchand / 10 ?? "''",
          //'Forfait gestion commerciale' => $item->c_smarchand / 10 ?? "''",
          //'Commission GMMS' => 75,
          //'NSIA' => 675 ,
        ]);
      }
    }
    return Excel::download(new ExcelListeCommissions($data), 'excel.xlsx');
  }


  public function export(Request $request)
  {
    $dataResult = $request->data;

    $data = [];
    if ($dataResult != null) {
      foreach (json_decode($dataResult) as $key => $item) {
        // dd($item);
        //dd($item);
        array_push($data, [
          'N°' => ++$key,
          'Souscripteur' => Client::where('id', $item->client_id)->first()->users->first()->getFullNameAttribute(),
          'Assuré' => Assure::where('id', $item->assure_id)->first()->users->first()->getFullNameAttribute(),
          'Numéro de police'  => $item->reference,
          'Montant'  => last($item->souscriptions)->primes ? last($item->souscriptions)->primes[0]->montant : "",
          'Prime totale Payée'  => sizeof(last($item->souscriptions)->primes),
          'Reste à Payer' => 12 - sizeof(last($item->souscriptions)->primes),
          // 'Commission Marchand' => $item->c_marchand/10 ?? "''",
          // 'Commission Super-marchand' => $item->c_smarchand/10 ?? "''",
          // 'Commission GMMS' => $item->c_mms/10 ?? "''",
          // 'NSIA' => $item->c_nsia/10 ?? "''",
          'Forfait gestion administrative' => 83.33,
          'Forfait gestion commerciale' => 166.67,
          'Commission GMMS' => 75,
          'NSIA' => 675,
        ]);
      }
    }
    return Excel::download(new ExcelExport($data), 'excel.xlsx');
  }

  public function exportPrime(Request $request)
  {
    $dataResult = $request->data;
    $data = [];
    if ($dataResult != null) {
      foreach (json_decode($dataResult) as $key => $item) {
        array_push($data, [
          'N°' => ++$key,
          'Date'  => $item->created_at,
          'Souscripteur' => Client::where('id', $item->client_id)->first()->users->first()->getFullNameAttribute(),
          'Numéro de police'  => $item->reference,
          'Montant'  => $item->montant,
          'Commission Marchand' => $item->c_marchand / 10 ?? "''",
          'Commission Super-marchand' => $item->c_smarchand / 10 ?? "''",
          'Forfait gestion administrative' => 83.33,
          'Forfait gestion commerciale' => 166.67,
          'Commission GMMS' => 75,
          'NSIA' => $item->c_nsia / 10 ?? "''",
        ]);
      }
    }
    return Excel::download(new ExcelExport($data), 'excel.xlsx');
  }


  /**
   * Undocumented function
   *
   * @param Request $request
   * @return void
   */
  public function exporttransfert(Request $request)

  {

    $dataResult = $request->data;
    // dd($dataResult);
    $data = [];
    foreach (json_decode($dataResult) as $key => $prime) {
      if ($prime->from_id != null && $prime->to_id != null) {
        array_push($data, [
          'N°' => ++$key,
          'source' => User::where('id', $prime->from_id)->first()["nom"] . ' ' . User::where('id', $prime->from_id)->first()["prenom"],
          'roleS' => User::where('id', $prime->from_id)->first() ? User::where('id', $prime->from_id)->first()->getRoleNames()[0] : '',
          'destination' => User::where('id', $prime->to_id)->first()["nom"] . ' ' . User::where('id', $prime->to_id)->first()["prenom"],
          'roleD' => User::where('id', $prime->to_id)->first() ? User::where('id', $prime->to_id)->first()->getRoleNames()[0] : '',
          'point' => $prime->amount,
          'date' => $prime->created_at,

        ]);
      }
      # code...
    }
    return Excel::download(new ExcelTransfert($data), 'Excel.xlsx');
  }
  public function exportContrat(Request $request)

  {

    $dataResult = $request->data;

    $data = [];
    if ($dataResult != null) {
      foreach (json_decode($dataResult) as $key => $item) {

        array_push(
          $data,
          [
            'N°' => ++$key,
            'Numéro de police'  => $item->reference,
            'Souscripteur' => Client::where('id', $item->client_id)->first()->users->first()->getFullNameAttribute(),
            'Assuré' => Assure::where('id', $item->assure_id)->first()->users->first()->getFullNameAttribute(),
            'Etat'  => Souscription::where('contrat_id', $item->id)->first()->statut,

          ]
        );
        //dd($data);
      }
    }
    return Excel::download(new ExcelExportMarchand($data), 'excel.xlsx');
  }


  public function exportPdfContrat(Request $request)
  {

    $contrats = json_decode($request->data);
    $debts = $request->debut;
    $fins = $request->fin;
    $data1s = $request->data1;
    $data2s = $request->data2;
    // dd($contrats);

    $pdf = PDF::loadView('dash.contrats.pdf', compact('contrats', 'debts', 'fins', 'data1s', 'data2s'));

    return $pdf->download('contrat_du_' . date('d-m-Y h:m:s') . '.pdf');
    //return $pdf->stream('contrat_'.date('d-m-Y s').'.pdf');
  }
  public function exportPdfContratM(Request $request)
  {

    $contrats = json_decode($request->data);
    $debts = $request->debut;
    $fins = $request->fin;
    $data1s = $request->data1;
    $data2s = $request->data2;
    //dd();

    $pdf = PDF::loadView('dash.contrats.pdfM', compact('contrats', 'debts', 'fins', 'data1s', 'data2s'));

    return $pdf->download('contrat_du_' . date('d-m-Y h:m:s') . '.pdf');
    //return $pdf->stream('contrat_'.date('d-m-Y s').'.pdf');
  }
  public function exportPdfTransfert(Request $request)
  {

    $data = json_decode($request->data);
    $historiques = [];
    foreach ($data as $key => $prime) {
      if ($prime->from_id != null && $prime->to_id != null) {
        array_push($historiques, [
          'source' => User::where('id', $prime->from_id)->first()["nom"] . ' ' . User::where('id', $prime->from_id)->first()["prenom"],
          'roleS' => User::where('id', $prime->from_id)->first() ? User::where('id', $prime->from_id)->first()->getRoleNames()[0] : '',
          'destination' => User::where('id', $prime->to_id)->first()["nom"] . ' ' . User::where('id', $prime->to_id)->first()["prenom"],
          'roleD' => User::where('id', $prime->to_id)->first() ? User::where('id', $prime->to_id)->first()->getRoleNames()[0] : '',
          'point' => $prime->amount,
          'date' => $prime->created_at,

        ]);
      }
      # code...
    }

    $pdf = PDF::loadView('dash.comptes.pdf', compact('historiques'));

    return $pdf->download('Transfert.pdf');
  }

  public function exportPdfEtat(Request $request)
  {
    $results = json_decode($request->data);
    $moisactuel = Carbon::now()->month;
    $debts = $request->debut;
    $fins = $request->fin;
    $resul = $request->data;
    //dd($results->sum('c_marchand'));
    $pdf = PDF::loadView('dash.etats.pdf', compact('results', 'moisactuel', 'debts', 'fins'));
    return $pdf->download('etat.pdf');
  }

  public function exportPrimePdfetat(Request $request)
  {
    $results = json_decode($request->data);
    $moisactuel = Carbon::now()->month;
    $debts = $request->debut;
    $fins = $request->fin;
    $resul = $request->data;
    //dd($results->sum('c_marchand'));
    $pdf = PDF::loadView('dash.etats.primespdf', compact('results', 'moisactuel', 'debts', 'fins'));
    return $pdf->download('etat.pdf');
  }

  public function etat_production(Request $request)
  {
    $start_time = microtime(true);

    $data['email'] = 'jospygoudalo@gmail.com';

    dispatch(new PrepareEtatProductionFile($data));
    toastr()->success('Vous recevrez un mail contenant le fichier demandé.', 'Fichier en cours de preparation');
    return redirect()->route('dash.index');
  }


  public function etat_recettes(Request $request)
  {
    $start_time = microtime(true);

    $data['email'] = 'jospygoudalo@gmail.com';

    dispatch(new PrepareRecetteFile($data));
    toastr()->success('Vous recevrez un mail contenant le fichier demandé.', 'Fichier en cours de preparation');
    return redirect()->route('dash.index');


    $primes = DB::table('primes')
      ->join('souscriptions', 'souscriptions.id', '=', 'primes.souscription_id')
      ->join('contrats', 'contrats.id', '=', 'souscriptions.contrat_id')
      ->join('clients', 'contrats.client_id', '=', 'clients.id')
      ->join('userables', 'clients.id', '=', 'userables.user_id')
      ->join('users', 'userables.user_id', '=', 'users.id')
      ->join('assures', 'contrats.assure_id', '=', 'assures.id')

      ->select(
        'primes.*',
        'contrats.id as contrat_id',
        'contrats.reference as contrat_reference',
        'clients.id as client_id',
        'users.nom as user_nom',
        'users.prenom as user_prenom',
        'users.telephone as user_telephone',
        'assures.id as assure_id'
      )
      ->get();

    #dd($primes);

    $data = [];
    if ($primes) {
      foreach ($primes as $key => $p) {
        $contrat = Contrat::find($p->contrat_id);
        $client = $contrat->client->users->first();

        array_push($data, [
          'DATE ADHESION'  => '$contrat->date_effet',

          'DATE DE PAIEMENT'  => $p->created_at,

          'NUMERO DE POLICE'  => $p->contrat_reference,
          'IDENTIFIANT SOUSCRIPTEUR'  => $p->client_id,

          'NOM & PRENOMS SOUSCRIPTEUR'  => $p->user_nom . " " . $p->user_prenom,
          'TELEPHONE' => $client->telephone,

          'NOM & PRENOMS ASSURE'  => '$contrat->assure->users->first()->full_name',

          'MONTANT PAYE'  => $p->montant,
          'QUOTE PART NSIA' => ((int) $p->c_nsia) / 10,
          'COMMISSION MMS'  => ((int) $p->c_mms) / 10,
          'COMMISSION SM' => ((int) $p->c_smarchand) / 10,
          'COMMISSION MARCHAND' => ((int) $p->c_marchand) / 10,
        ]);
      }
      $e1 = microtime(true);
      dump($e1 - $start_time);
      dd($data);
      return Excel::create(new ExcelRecettes($data), 'recettes.xlsx')->store('xlsx', storage_path('excel/exports'));
    }
    dd('pas de donnée');
  }




  // public function etat_recettes(Request $request)
  // {
  //   $clients = Client::all();
  //   $data = [];
  //   if($clients){
  //       foreach ($clients as $key => $client) {
  //           array_push($data, [
  //               'DATE ADHESION'  => $p->souscription->contrat->date_effet,
  //               'DATE DE PAIEMENT'  => $p->created_at,
  //               'NUMERO DE POLICE'  => $p->souscription->contrat->reference,
  //               'IDENTIFIANT SOUSCRIPTEUR'  => $p->souscription->contrat->client->users->first()->id,
  //               'NOM & PRENOMS SOUSCRIPTEUR'  => $p->souscription->contrat->client->users->first()->full_name,
  //               'TELEPHONE' => $p->souscription->contrat->client->users->first()->telephone,
  //               'NOM & PRENOMS ASSURE'  => $p->souscription->contrat->assure->users->first()->full_name,
  //               'MONTANT PAYE'  => $p->montant,
  //               'QUOTE PART NSIA' => ((int) $p->c_nsia) / 10,
  //               'COMMISSION MMS'  => ((int) $p->c_mms) / 10,
  //               'COMMISSION SM' => ((int) $p->c_smarchand) / 10,
  //               'COMMISSION MARCHAND' => ((int) $p->c_marchand) / 10,
  //           ]);
  //       }
  //       return Excel::download(new ExcelRecettes($data), 'excel.xlsx');
  //   }
  //   dd('pas de donnée');
  // }

  public function show()
  {
    return view('dash.etats.index');
  }

  public function generate(Request $request)
  {
    # dd($request->all());
    $interval = [$request->debut . " 00:00:00", $request->fin . " 23:59:59"];

    switch ($request->etat) {
      case 'global':
        $contrats = Contrat::whereBetween('created_at', $interval)->get()->load('souscriptions.primes', 'client.users', 'assure.users', 'marchands.users', 'marchands.super_marchands.users',);
        $data = ["contrats" => $contrats];
        return Excel::download(new EtatGlobal($data), 'EtatGlobal' . time() . '.xlsx');
        break;

      case 'production_nsia':
        $contrats = Contrat::whereBetween('created_at', $interval)->get()->load('souscriptions.primes', 'client.users', 'assure.users', 'marchands.users', 'marchands.super_marchands.users',);
        $data = ["contrats" => $contrats];
        return Excel::download(new ProductionNsia($data), 'ProductionNsia' . time() . '.xlsx');
        break;

      case 'utilisateur':
        $users = User::whereBetween('created_at', $interval)->get()->load('roles', 'commune', 'commune.departement');
        $data = ["users" => $users];
        return Excel::download(new EtatUtilisateurs($data), 'EtatUtilisateurs' . time() . '.xlsx');
        break;

      case 'productionmetsm':
        $users = User::role(['SuperMarchand', 'Marchand'])->get()->load('wallets', 'roles', 'commune', 'commune.departement');
        $data = ["users" => $users];
        #return view('dash.etats.tables.prod_m_et_sm', compact('users'));
        return Excel::download(new ProductionMSm($data), 'ProductionMSm' . time() . '.xlsx');
        break;

      case 'primes':
        $primes = Primes::whereBetween('created_at', $interval)->get()->load('souscription.contrat.client.users', 'souscription.contrat.marchands.users');
        $data = ["primes" => $primes];
        #return view('dash.etats.tables.primes', compact('primes'));
        return Excel::download(new EtatPrime($data), 'EtatPrime' . time() . '.xlsx');
        break;

      default:
        # code...
        break;
    }
  }
}

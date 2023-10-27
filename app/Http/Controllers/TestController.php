<?php

namespace App\Http\Controllers;

use App\Jobs\Paiements\CheckPaiementStatusJob;
use Auth;
use Session;
use App\User;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Assure;
use App\Models\Beneficiaire;
use App\Models\SuperMarchand;
use App\Models\Contrat;
use App\Models\Fichier;
use Illuminate\Http\Request;
use App\Models\Souscription;
use App\Models\StatutSouscription;
use App\Models\MobileMoney;

use App\Jobs\SouscriptionPayment;
use App\Jobs\TestMailJob;
use App\Mail\TestMail;
use App\Notifications\TestNotification;
use App\Traits\MobilePaiement;
use App\Traits\ServicesValidationTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\New_;

class TestController extends Controller
{

  use MobilePaiement, ServicesValidationTrait;

  public function withparams(Request $request)
  {
    $contrat = Contrat::findOrFail($request->c);
    dd($contrat->statut);
  }

  public function test1()
  {
    $i = 0;
    $contrats = [
      // '19A123N1609', '20M441N1277', '20M484N1611', '20M485N1685', '20M486N1410', '20M56N4290', '26A296N1726', '26A413N1853', '26A413N2181', '26A413N5708', '26A472N4126', '26A472N5348', '26A87N7500', '26A94N3646', '28L11N19327', '28L11N4566', '31U129N1527', '31U187N1622', '31U187N2131', '31U68N1781', '32L324N1488', '32L473N1704', '32L69N1618', '32L69N2384', '32L81N1649', '35A499N4739', '35A499N5574', '36Z292N1109', '40B194N2356', '40B275N7679', '40B481N1552', '40B481N3608', '40B517N1979', '46L152N31828', '46L152N35453', '46L152N39666', '46L321N1365', '46L321N2427', '46L321N3867', '46L322N1488', '46L322N2666', '46L322N4511', '46L323N3666', '46L6N12148', '46L6N208486', '46L6N352894', '46L7N100384', '46L7N110907', '46L7N125768', '46L7N126775', '46L7N127142', '46L7N128700', '46L7N137948', '46L7N138583', '46L7N140513', '46L7N151593', '46L7N182445', '46L7N202779', '46L7N224884', '46L7N241991', '46L7N29671', '46L7N35540', '48L155N1943', '48L156N24370', '48L156N5274', '48L321N9937', '48L322N23559', '48L322N31141', '48L322N44569', '48L322N65504', '48L322N71710', '48L323N19759', '48L323N20394', '48L323N21921', '48L323N27645', '48L323N34211', '48L323N35708', '48L323N36764', '48L323N38333', '48L323N39176', '48L323N4596', '48L323N6168', '48L323N7178', '48L475N2648', '48L475N3537', '48L476N1500', '48L476N2195', '48L477N2938', '48L477N4782', '48L477N6925', '48L477N8401', '48L489N17735', '48L489N35673', '48L489N38977', '48L489N55683', '48L489N58345', '48L489N61548', '48L489N81655', '48L489N88282', '48L489N90326', '48L489N91768', '4L165N1529', '4L165N2129', '4L39N1792', '4L39N2436', '51O350N1163', '51O452N1257', '51O452N2396', '52M519N2847', '6A26N1388', '8A226N1736',
      '46L7N101597', '46L321N4952', '46L322N6391', '46L322N7638', '46L322N8782', '46L322N9450', '46L322N10348', '51O452N4417', '46L152N34619', '46L7N124869', '48L489N12257', '28L11N20912',
      '48L322N22712', '48L489N18172', '48L489N19345', '48L322N24494', '48L322N30541', '48L489N29222', '48L322N33618', '48L322N34698', '46L7N197317', '48L323N16216', '48L322N43512', '48L322N52157', '48L322N53808', '14L74N1567', '28L11N34819', '46L7N229760', '46L7N230144', '46L7N238929', '48L322N74827', '48L489N89695', '48L489N100331', '48L322N78172', '48L322N79637', '48L322N80954', '48L322N81688', '48L489N104630', '48L489N105632', '48L489N126475', '48L489N131875', '46L7N268928', '48L323N54125', '48L322N93121', '46L7N275299', '48L322N98252', '57A528N2148', '57A528N3144', '48L489N150703', '46L7N314133', '48L322N112568', '48L489N154368', '46L7N320746', '46L7N321885', '48L533N8454', '57A531N2284', '48L323N78750', '46L7N325722', '46L7N326773', '48L323N79988', '48L541N9774', '48L322N128547', '48L489N187545',
    ];
    foreach ($contrats as $key => $c) {
      $contrat = Contrat::where('reference', $c)->first();
      if ($contrat->statut !== "Résilié") {
        $statut = StatutSouscription::whereLabel('Résilié')->first();
        $contrat->souscriptions->last()->update(['statut' => $statut->label]);
        $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => Auth::id(), 'motif' => "non paiement de prime"]);
        $i++;
      } else {
        toastr()->success('Contrat résilié avec succès.', 'success');
      }
    }
    dd($i);
  }

  public function test2()
  {
    $status = $this->get_status('1601883508EHWHLINMIA', 'MTN');
    dd('ok');

    return redirect()->route('contrats.show', $contrat->reference);
  }

  public function test3()
  {
    // recalculer déja les commissions si contrat en retart ici
    $souscription = Souscription::find(1);
    dd($souscription->retardEnJours);

    // comment determiner si un contrat est en retard ... magnifique question
    // $souscription->
    // on recupere date de validation du contrat, on trouve le nombre de mois totale entre ce jour et aujourdhui
    // si le nombre de mois > au nombre de primes alors le contrat est en retard si non il ne l'est pas

  }

  public function test4()
  {
    $transref = "1585905700EHWHLINMMV";

    // $context = '74.208.84.251:8221';
    // $url = $context . '/QosicBridge/user/gettransactionstatus';
    // $clientid = config('paiement.MTN.CLIENTID');
    // $server_user = config('paiement.MTN.USERNAME');
    // $server_pass = config('paiement.MTN.PASSWORD');
    // $data = array(
    //   "transref" => $transref,
    //   "clientid" => $clientid,
    // );
    // dd([$server_user, $server_pass]);
    // $client = new \GuzzleHttp\Client(['headers' => ['content-type' => 'application/json']]);
    // $response = $client->request('POST', $url, [
    //   'auth' => [$server_user, $server_pass],
    //   'json' => $data,
    //   'verify' => false,
    // ]);
    // dump("Get Transaction Status");
    // dump($data);
    // dump("Status Code: " . $response->getStatusCode());
    // $response = $response->getBody()->getContents();
    // dump($response);
    // dump(json_decode($response));
    // $response = json_decode($response); //json proper
    // dump("Response: " . $response->responsecode);
    // dump("Responsemsg: " . $response->responsemsg);
    // dump("Transref: " . $response->transref);
    // dump("Comment: " . $response->comment);
    // return dd('-------------');

    $data = [
      'transref' => $transref,
      'clientid' => config('paiement.MTN.CLIENTID'),
    ];
    $client = new \GuzzleHttp\Client(['headers' => ['content-type' => 'application/json'], 'verify' => false]);
    $response = $client->request('POST', config('paiement.MTN.TRANSACTION_STATE_URL'), [
      'auth' => [config('paiement.MTN.USERNAME'), config('paiement.MTN.PASSWORD')], 'json' => $data,
    ]);
    dump('Verification état de la transaction...');
    $response = $response->getBody()->getContents();
    $str_response = $response;
    $response = json_decode($response); //json proper
    dd($response);

    // // $momo = MobileMoney::where('transref', '=', $transref)->first();
    // // $momo->update([
    // //     'response'      => $str_response,
    // //     'response_code' => $response->responsecode,
    // //     'response_msg'  => $response->responsemsg,
    // // ]);
    // return $response;
  }



  public function changeflowcontrat(Request $request)
  {
    ini_set('max_execution_time', 360000);

    // C'est reelement ici que ca commence.
    $contrat_a_traiter = Contrat::withCount(["cprimes"])->get()->whereIn('statut', ["Attente de validation"])->where('cprimes_count', '>', 0);
    // dd($contrat_a_traiter);
    $statut = StatutSouscription::whereLabel('Valide')->get();
    foreach ($contrat_a_traiter as $key => $c) {
      $created_at = $c->souscriptions->last()->primes->first()->created_at; // date de creation de la 1er prime
      $user_id = $c->souscriptions->last()->primes->first()->user_id; // le user qui a payé la premiere prime
      $c->souscriptions->last()->update(['statut' => "Valide", 'date_effet' => $created_at]);
      $c->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $user_id, 'motif' => "Premiere prime payée", "created_at" => $created_at]);
    }


    $contrat_a_traiter = Contrat::withCount(["cprimes"])->get()->whereIn('statut', ["Terminé"])->where('cprimes_count', 12);
    $statut = StatutSouscription::whereLabel('Valide')->get();
    foreach ($contrat_a_traiter as $key => $c) {
      $created_at = $c->souscriptions->last()->primes->first()->created_at; // date de creation de la 1er prime
      $user_id = $c->souscriptions->last()->primes->first()->user_id; // le user qui a payé la premiere prime
      $c->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $user_id, 'motif' => "Premiere prime payée", "created_at" => $created_at]);
    }



    $contrat_a_traiter = Contrat::withCount(["cprimes"])->get()->whereIn('statut', ["Valide"])->where('cprimes_count', '=', 12);
    //dd($contrat_a_traiter);
    foreach ($contrat_a_traiter as $key => $c) {
      $statut = StatutSouscription::whereLabel('Terminé')->get();
      $created_at = $c->souscriptions->last()->primes->last()->created_at; // date de creation de la 1er prime
      $user_id = $c->souscriptions->last()->primes->last()->user_id; // le user qui a payé la premiere prime
      $c->souscriptions->last()->update(['statut' => "Terminé", 'date_effet' => $created_at]);
      $c->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $user_id, 'motif' => "Primes totalement payées", "created_at" => $created_at]);
    }



    dump($contrat_a_traiter);

    dd(
      [
        "souscriptions" => Souscription::all()->groupBy("statut"),
        "all" => Contrat::all()->count(),
      ]
    );
  }


  public function paiement()
  {
    $payingUser = Auth::user();
    if ($payingUser) {
      $paiement = $this->pay($payingUser, 1, "MTN", "Test equipe technique");
      if ($paiement['status'] == "SUCCESS") {
        dump("Paiement effectué");
      } else {
        dump("Paiement non effectué");
        CheckPaiementStatusJob::dispatch($paiement['transref'], Contrat::inRandomOrder()->first(), Auth::id(), "test")->delay(now()->addMinutes(3));
      }
      dd($paiement);
    } else {
      return "Numéro non existant";
    }
  }

  public function mail()
  {
    Log::channel('horizon_log_channel')->info('Test : 1F payé sur le contrat aléatoire:');
    dd("ok");
    for ($i = 0; $i < 2; $i++) {
      TestMailJob::dispatch();
    }
    Log::info('Dispatched order 1');
    return 'Dispatched order 1';
  }

  public function notif()
  {
    $contrat = Contrat::where('reference', '=', '9L109N3771')->first();

    // $this->process_paiement_prime($contrat, 1000, Auth::id());
    #Auth::user()->notify(New TestNotification);

    $data = [
      'reference' => '9L109N3771',
      'type' => 'prime'
    ];
    Mail::send('email.newcorrection', $data, function ($m) use ($data) {

      $m->from(config('mail.from.address'), config('mail.from.name'))
        ->to('jospygoudalo@gmail.com')
        ->subject('Régularisation automatique. ' . $data['type'] . ' : ' . $data['reference']);
    });
  }

  public function sms()
  {
    // $this->sendSMS('Ceci est un test', Auth::user());



  }
}

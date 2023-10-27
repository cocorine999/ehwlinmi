<?php

namespace App\Http\Controllers;

use App\Models\MobileMoney;
use App\Models\Contrat;
use Illuminate\Http\Request;
use App\Exports\ExcelTransfert;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class MobileMoneyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $transactions = MobileMoney::with('user')->orderBy('created_at', 'DESC')->paginate(1000);
    return view('dash.transactions.index', compact(['transactions']));
  }

  public function contrat_transactions($reference)
  {
    $contrat = Contrat::where('reference', $reference)->first();
    if ($contrat) {
      $transactions = MobileMoney::where('narration', 'like', $contrat->reference . '%')->paginate(1000);
    } else {
      abort(404);
    }
    return view('dash.transactions.index', compact(['transactions']));
  }

  public function show(MobileMoney $mobileMoney)
  {
    return view('dash.transactions.show', compact(['mobileMoney']));
  }

  public function exportTransfert(Request $request)
  {
    $dataResult = $request->data;
    $transactions = MobileMoney::all();
    $data = [];
    foreach ($transactions as $key => $t) {
      array_push($data, [
        'N°' => ++$key,
        'Dest.' => $t->msisdn,
        'Operation' => $t->operation_type,
        'Operateur' => $t->operateur,
        'Motif' => $t->narration,
        'Montant' => $t->amount,
        'transref' => $t->transref,
        'Nom' => $t->lastname,
        'Prénom' => $t->firstname,
        'Response' => $t->response_msg,
        'Par' => $t->shortFullName,
      ]);
    }
    return Excel::download(new ExcelTransfert($data), 'Transfert du_' . date('d-m-Y h:m:s') . '.xlsx');
  }

  public function mobileMoneytPdf(Request $request)
  {
    $transactions = MobileMoney::all();
    $pdf = PDF::loadView('dash.transactions.pdf', compact('transactions'));
    return $pdf->download('transactions_du_' . date('d-m-Y h:m:s') . '.pdf');
  }
}

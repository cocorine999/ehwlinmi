<!DOCTYPE html>
<html>

<head>
{{--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  --}}
   <style>
 @page { margin: 100px 50px; }
        .header { position: fixed; left: 0px; top: 30px; right: 0px; height: 100px; text-align: center; background-color:blue ;color:white }
        .footer { position: fixed; left: 0px; bottom: 8px; right: 0px; font-size: 0.6em }
        .footer .pagenum:before { content: counter(page); }
        table { border-collapse: collapse;width: 100%; }
        th,td {border: 0.4px solid black;font-size: 0.7em; }
       .marron{
            background-color: rgba(173, 216, 230) !important;
            color: #fff !important;
        }
        tr, td{
            height:29px;

        }
        h1{
            color:blue;
            text-align:center;
        }
         html{

              background-position: center !important;
              background-repeat: no-repeat !important;
              width:100%;
              height:100%;
              background-size: 100px;
           }
           body
           {
               background-image: url("logotpdf.png") ;
               background-repeat: no-repeat !important;
               background-position: center !important;
           }
        </style>


</head>
    <div class="footer" >
        <center> NSIA-GMMS | EH WHLIN MI ASSURANCE  </center>
        <span class="pagenum" style="float: right; text-align:center">  </span> <br>
        </div>
    <header>
        <table  style="margin-top:-80px">
          <td style="border:0px;width:100%;text-align:center" >
                  <br>
                  <br>
                    NSIA-GMMS
                  <br>
                  <span>.......</span>
            </td>
        </table>
    </header>
        <br>
        <br>
        <table  style="margin-top:-80px">
            <td style="border:0px;width:100%;text-align:center" >
                    <br>
                    <br>
                      EH WHLIN MI ASSURANCE
                    <br>
                    <span>.......</span>
            </td>
        </table>
        <table style="margin-top:-15px">
            <td style="border:0px;width: 50px">
              Date {{ "d'exportation" }} :
              <b>   {{date("d-m-Y")}}  </b> <br>
              Exporté par :
              <b>{{Auth::user()->first()->getFullNameAttribute()}}</b>  <br>
              @if($debts != null)
              Liste des primes payées entre le <b>{{date('d-m-Y', strtotime($debts))}} et le
                {{date('d-m-Y', strtotime($fins))}} </b>
              <br>
              <br>
              @endif
            </td>
        </table>

     <center> <u><h2  ><b>LISTE DES PRIMES  </b></h2></u>  </center>

   <table id="example1" class="table table-bordered table-hover ">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Souscripteur</th>
                    <th>Assuré</th>
                    <th>Numéro de police</th>
                    <th>Montant</th>
                    <th>Prime Totale Payée</th>
                    <th>Reste à payer</th>
                    <th>Commission Marchand</th>
                    <th>Commission Super-marchand</th>
                    <th>Commission GMMS</th>
                    <th>NSIA</th>
                    <th>Date de payement</th>
                  </tr>
                </thead>
                <tbody>
                @if($results != null)
                  @foreach ($results as $key=>$prime)
                      <tr class="{{ App\Models\Primes::where('souscription_id',$prime->souscription_id)->get()->count() >= $moisactuel ? 'text-success':'text-danger'}}">
                        <td>{{ ++$key}} </td>
                        <td>{{App\Models\Client::where('id',$prime->client_id)->first()->users->first()->getFullNameAttribute() }} </td>
                        <td>{{App\Models\Assure::where('id',$prime->id_assure)->first()->users->first()->getFullNameAttribute()}} </td>
                        <td>{{ $prime->reference}} </td>
                        <td>{{ $prime->montant}} </td>
                        <td>{{App\Models\Primes::where('souscription_id',$prime->souscription_id)->get()->count()}} </td>
                        <td>{{ 12 - App\Models\Primes::where('souscription_id',$prime->souscription_id)->get()->count()}} </td>
                        <td>{{ $prime->c_marchand/10 }} </td>
                        <td>{{ $prime->c_smarchand/10 ?? ''}} </td>
                        <td>{{ $prime->c_mms/10 ?? ''}} </td>
                        <td>{{ $prime->c_nsia/10 ?? ''}} </td>
                        <td class="d-none d-sm-table-cell text-center p-1">
                          {{ $prime->date}}
                        </td>
                    </tr>
                  @endforeach
                  @endif
                </tbody>
                <tfoot>
                 @if($results != null)
                    <tr>

                    <td class="table-label text-center" colspan="7"> Total </td>
                   {{--   <td class="table-label"> Total</td>SUM( price )  --}}
                    <td class="table-amount">{{ collect($results)->sum('c_marchand')/10  }}   </td>
                    <td class="table-amount"> {{ collect($results)->sum('c_smarchand')/10 }}</td>
                    <td class="table-amount"> {{ collect($results)->sum('c_mms')/10  }}</td>
                    <td class="table-amount"> {{ collect($results)->sum('c_nsia')/10  }}</td>
                    <td class="table-amount"> {{ date('Y-m-d')  }}</td>

                    </tr>
                  @endif

                </tfoot>
              </table>
    <div class="footer" >

    </div>
</body>
</html>



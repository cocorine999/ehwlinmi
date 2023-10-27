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
              {{--  @if($debts != null)
              Période {{ "d'exportation" }} :
              <b>{{date('d-m-Y', strtotime($debts))}} à {{date('d-m-Y', strtotime($fins))}} </b>  <br>
              @endif  --}}
            </td>
        </table>

    <center> <u><h2  ><b>LISTE DES TRANSACRIONS MOBILE MONEY  </b></h2></u>  </center>

      <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Dest.</th>
                    <th>Operation</th>
                    <th>Operateur</th>
                    <th>Motif</th>
                    <th>Montant</th>
                    <th>transref</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Response</th>
                    <th>Effectuée le</th>
                    <th>Par</th>
                  </tr>
                </thead>
                <tbody>
                     @foreach ($transactions as $t)
                      <tr>
                        <td>{{ $t->msisdn }} </td>
                        <td>{{ $t->operation_type }} </td>
                        <td>{{ $t->operateur }} </td>
                        <td>{{ $t->narration }} </td>
                        <td>{{ $t->amount }} </td>
                        <td>{{ $t->transref }} </td>
                        <td>{{ $t->lastname }} </td>
                        <td>{{ $t->firstname }} </td>
                        <td>{{ $t->response_msg }} </td>
                        <td>{{ $t->updated_at }} </td>
                        <td>{{ $t->user->shortFullName }} </td>
                      </tr>
                     @endforeach
                </tbody>
              </table>
    <div class="footer" >

    </div>
</body>
</html>



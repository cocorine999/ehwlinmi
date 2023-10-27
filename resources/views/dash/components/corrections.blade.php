<table id="example1" class="table table-bordered table-hover data-table">
  <thead>
    <tr>
      <th>N°</th>
      <th>Type</th>
      <th>Réference</th>
      <th>Prime</th>
      <th>Transref</th>
      <th>date</th>
      <th>Par</th>
      <th>le</th>
    </tr>
  </thead>
  <tbody>
  @if($corrections)
    @foreach ($corrections as $key=>$correction)
      <tr class="">
          <td>{{++$key}}</td>
          <td>{{$correction->type}}</td>
          <td>{{$correction->contrat->reference}}</td>
          <td>{{$correction->montant}}</td>
          <td>{{$correction->mobile_money->transref}}</td>
          <td>{{$correction->date}}</td>
          <td>{{$correction->user->fullname}}</td>
          <td>{{$correction->created_at}}</span></td>
      </tr>
    @endforeach
      @else
          <tr>
              <td class="" colspan="5">Pas de corrections disponibles</td>
          </tr>
      @endif
  </tbody>
</table>

<table id="example1" class="table table-bordered table-hover data-table">
  <thead>
    <tr>
      <th>N°</th>
      <th>Numéro de police</th>
      <th>Souscripteur</th>
      <th>Assuré</th>
      <th>Marchand</th>
      <th>Primes</th>
      <th>Statut</th>
      <th class="d-none">En retard</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @if($contrats)
    @foreach ($contrats as $key=>$contrat)
    <tr class="{{ $contrat->retardEnJours ? 'text-danger' : 'text-success' }}">
      <td>{{++$key}}</td>
      <td>{{$contrat->reference}}</td>
      <td>{{$contrat->client->users->first()->full_name}}</td>
      <td>{{$contrat->assure->users->first()->full_name}}</td>
      <td>{{$contrat->marchands->last()->users->first()->full_name}}</td>
      <td><span>{{$contrat->primes->count()}}</span></td>
      <td><span class="badge badge-primary">{{$contrat->statut}}</span></td>
      <td class="d-none">{{$contrat->retardEnJours}}</td>
      <td class="d-none d-sm-table-cell text-center p-1">
        <div class="mx-auto">
          <a href="{{route('contrats.show', $contrat->reference)}}" class="mx-0 btn btn-sm btn-primary"
            data-toggle="tooltip" title="Voir">
            <i class="fa fa-fw fa-eye"></i>
          </a>
        </div>
      </td>
    </tr>
    @endforeach
    @else
    <tr>
      <td class="" colspan="5">Pas de contrats disponibles</td>
    </tr>
    @endif
  </tbody>
</table>

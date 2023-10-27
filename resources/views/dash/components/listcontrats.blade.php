            <table id="example1" class="table table-bordered table-hover data-table">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Numéro de police</th>
                    <th>Souscripteur</th>
                    <th>Assuré</th>
                    <th>Statut</th>
                    <th>Primes</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @if($contrats)

                  @foreach ($contrats as $key=>$contrat)

                        @if(App\Models\Primes::where('souscription_id',$contrat->souscription_id)->get()->count() >= $moisactuel)
                    <tr class="text-success">

                        <td>{{++$key}}</td>

                        <td>{{$contrat->reference}}</td>

                       {{--   <td>{{ $contrat->marchand->users()->first()->getFullNameAttribute() }}</td>  --}}
                        <td>{{App\Models\Client::where('id',$contrat->client_id)->first()->users->first()->getFullNameAttribute() }} </td>
                        <td>{{App\Models\Assure::where('id',$contrat->assure_id)->first()->users->first()->getFullNameAttribute()}} </td>
                        <td><span class="badge badge-primary">{{$contrat->statut}}</span></td>
                        <td><span>{{App\Models\Contrat::find($contrat->id)->primes->count()}}</span></td>
                        <td class="d-none d-sm-table-cell text-center p-1">
                          <div class="mx-auto">
                              <a href="{{route('contrats.show', $contrat->reference)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                                <i class="fa fa-fw fa-eye"></i>
                              </a>
                          </div>
                        </td>
                    </tr>
                    @else
                    <tr class="text-danger">

                        <td>{{++$key}}</td>
                        <td>{{$contrat->reference}}</td>
                       {{--   <td>{{ $contrat->marchand->users()->first()->getFullNameAttribute() }}</td>  --}}
                        <td>{{App\Models\Client::where('id',$contrat->client_id)->first()->users->first()->getFullNameAttribute() }} </td>
                        <td>{{App\Models\Assure::where('id',$contrat->assure_id)->first()->users->first()->getFullNameAttribute()}} </td>
                        <td><span class="badge badge-primary">{{$contrat->statut}}</span></td>
                        <td><span>{{App\Models\Contrat::find($contrat->id)->primes->count()}}</span></td>
                        <td class="d-none d-sm-table-cell text-center p-1">
                          <div class="mx-auto">
                              <a href="{{route('contrats.show', $contrat->reference)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                                <i class="fa fa-fw fa-eye"></i>
                              </a>
                          </div>
                        </td>
                    </tr>
                    @endif
                  @endforeach
                @else
                    <tr>
                      <td class="" colspan="5">Pas de contrats disponibles</td>
                    </tr>
                @endif
                </tbody>
              </table>

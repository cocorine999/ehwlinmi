<table>
  <tbody>
    <tr>
      <td>Date d'adhesion</td>
      <td>Code produit</td>
      <td>Date de souscrption</td>
      <td>Nom et Pr&eacute;noms de l&rsquo;adh&eacute;rent</td>
      <td>Profession de l&rsquo;adh&eacute;rent</td>
      <td>Num&eacute;ro de t&eacute;l&eacute;phone de l&rsquo;adh&eacute;rent</td>
      <td>Nom et pr&eacute;noms de l&rsquo;assur&eacute;</td>
      <td>Date de naisance de l'assur&eacute;e</td>
      <td>Code marchand</td>
      <td>Non et pr&eacute;noms du marchand</td>
      <td>Code supermarchand</td>
      <td>Nom et pr&eacute;noms de super marchand</td>
      <td>Statut</td>
      <td>Depuis le</td>
      <td>Primes pay&eacute;es</td>
      <td>Date du sinistre</td>
      <td>Sinistre trait&eacute;</td>
    </tr>
    @foreach ($contrats as $l)
    <tr>
      <td>{{ $l->created_at }}</td>
      <td>{{ $l->reference }}</td>
      <td>{{ optional($l->souscriptions->last()->primes->first())->created_at }}</td>
      <td>{{ $l->client->users->first()->full_name }}</td>
      <td>{{ $l->client->users->first()->profession }}</td>
      <td>{{ $l->client->users->first()->telephone }}</td>
      <td>{{ $l->assure->users->first()->full_name }}</td>
      <td>{{ optional($l->assure->users->first()->date_naissance)->format('Y-m-d') }}</td>
      <td>{{ $l->marchands->last()->users->first()->reference }}</td>
      <td>{{ $l->marchands->last()->users->first()->full_name }}</td>
      <td>{{ $l->marchands->last()->super_marchands->last()->users->first()->reference }}</td>
      <td>{{ $l->marchands->last()->super_marchands->last()->users->first()->full_name }}</td>
      <td>{{ $l->souscriptions->last()->statut }}</td>
      <td>{{ $l->souscriptions->last()->updated_at }}</td>
      <td>{{ $l->souscriptions->last()->primes->count() }}</td>
      <td>{{ optional($l->sinistre)->created_at }}</td>
      <td>{{ optional($l->sinistre)->updated_at }}</td>
    </tr>
    @endforeach

  </tbody>
</table>
<p>&nbsp;</p>

<table>
<tbody>
<tr>
<td>N&deg; ordre</td>
<td>Nom et prenom des souscripteurs</td>
<td>R&eacute;f&eacute;rence de contrat</td>
<td>T&eacute;l&eacute;phone du souscripteur</td>
<td>Telephone de l'agent &nbsp; </td>
<td>Montant pay&eacute;</td>
<td>Nombre de primes pay&eacute;es</td>
<td>Date de payement</td>
<td>Commission SM</td>
<td>Commission Marchand</td>
<td>Commission NSIA</td>
<td>Commission GMMS</td>
<td>Forfait de gestion Administrative</td>
<td>Forfait de gestion des commerciaux</td>
</tr>
@foreach ($primes as $key => $l)
<tr>
  <td>{{ $key }}</td>
  <td>{{ $l->souscription->contrat->client->users->first()->full_name}}</td>
  <td>{{ $l->souscription->contrat->reference }}</td>
  <td>{{ $l->souscription->contrat->marchands->last()->users->first()->telephone }}</td>
  <td>{{ $l->souscription->contrat->client->users->first()->telephone }}</td>
  <td>{{ $l->montant }}</td>
  <td>1</td>
  <td>{{ $l->created_at }}</td>
  <td>{{ $l->c_smarchand / 10 }}</td>
  <td>{{ $l->c_first_marchand / 10 + $l->c_marchand / 10}}</td>
  <td>{{ $l->c_nsia / 10 }}</td>
  <td>{{ $l->c_mms / 10 }}</td>
  <td>83.33</td>
  <td>166.67</td>
</tr>
@endforeach
</tbody>
</table>

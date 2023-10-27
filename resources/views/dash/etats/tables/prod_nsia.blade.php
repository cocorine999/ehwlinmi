<table>
  <tbody>
    <tr>
      <td>N&deg; ordre</td>
      <td>Date d'adh&eacute;sion</td>
      <td>Code produit</td>
      <td>Code de l'agent&nbsp;&nbsp;&nbsp; </td>
      <td>Nom et prenom de l'adh&eacute;rent</td>
      <td>Profession de l'adh&eacute;rent&nbsp;&nbsp; </td>
      <td>Telephone de l'adh&eacute;rent&nbsp;&nbsp;&nbsp; </td>
      <td>Nom et pr&eacute;nom de l'assur&eacute;&nbsp;&nbsp; </td>
      <td>R&eacute;ponse au questionnaire m&eacute;dical</td>
    </tr>
    @foreach ($contrats as $key => $l)
    <tr>
      <td>{{ $key }}</td>
      <td>{{ optional($l->souscriptions->last()->primes->first())->created_at }}</td>
      <td>{{ $l->reference }}</td>
      <td>{{ $l->marchands->last()->users->first()->reference }}</td>
      <td>{{ $l->client->users->first()->full_name }}</td>
      <td>{{ $l->client->users->first()->profession }}</td>
      <td>{{ $l->client->users->first()->telephone }}</td>
      <td>{{ $l->assure->users->first()->full_name }}</td>
      <td>{{ $l->reponse_question_medical }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

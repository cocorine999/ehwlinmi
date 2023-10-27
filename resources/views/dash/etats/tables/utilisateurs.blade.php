<table>
<tbody>
<tr>
<td>N&deg; ordre</td>
<td>Nom et pr&eacute;nom</td>
<td>Code de l'agent&nbsp;&nbsp;&nbsp;</td>
<td>Type de personne (Physique ou morale) </td>
<td>Telephone de l'agent &nbsp; </td>
<td>D&eacute;partement</td>
<td>Commune </td>
<td>Role(s)</td>
<td>Date de cr&eacute;ation du compte</td>
<td>Etat du compte (Activ&eacute;/D&eacute;sactiv&eacute;)</td>
</tr>
@foreach ($users as $key => $l)
<tr>
  <td>{{ $key }}</td>
  <td>{{ $l->full_name }}</td>
  <td>{{ $l->reference }}</td>
  <td>{{ $l->type_personne }}</td>
  <td>{{ $l->telephone }}</td>
  <td>{{ $l->commune->departement->nom }}</td>
  <td>{{ $l->commune->nom }}</td>
  <td>
    @foreach($l->getRoleNames() as $r)
      <span class="badge badge-primary">{{$r}}</span>
    @endforeach
  </td>
  <td>{{ $l->created_at }}</td>
  <td>{{ $l->banned_until ? "Désactivé" : "Activé" }}</td>
</tr>
@endforeach
</tbody>
</table>
<p>&nbsp;</p>

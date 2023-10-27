<table>
  <tbody>
    <tr>
      <td>N&deg; ordre</td>
      <td>Nom et pr&eacute;nom</td>
      <td>Code de l'agent&nbsp;&nbsp;&nbsp;</td>
      <td>Type de personne (Physique ou morale) </td>
      <td>Telephone de l'agent &nbsp; </td>
      <td>Profession de l'agent</td>
      {{-- <td>Nombre de contrats valid&eacute;s</td>
<td>Nombre de contrats non&nbsp; valid&eacute;s</td> --}}
      <td>Nombre de contrats</td>
      <td>Commission totale</td>
      <td>Commission retir&eacute;e</td>
      <td>Commission d&ucirc;e</td>
    </tr>
    @foreach ($users as $key => $l)
    <tr>
      <td>{{ $key }}</td>
      <td>{{ $l->full_name }}</td>
      <td>{{ $l->reference }}</td>
      <td>{{ $l->type_personne }}</td>
      <td>{{ $l->telephone }}</td>
      <td>{{ $l->profession }}</td>
      {{-- <td>{{ optional($l->contrat_valides)->count() }}</td>
      <td>{{ optional($l->contrat_list)->count() - optional($l->contrat_valides)->count() }}</td> --}}
      <td>{{ optional($l->contrat_list)->count() }}</td>
      <td>{{ (optional($l->getWallet('commission'))->balance + optional($l->getWallet('retrait'))->balance) / 10 }}</td>
      <td>{{ optional($l->getWallet('retrait'))->balance / 10 }}</td>
      <td>{{ optional($l->getWallet('commission'))->balance / 10 }}</td>
    </tr>
    @endforeach

  </tbody>
</table>
<p>&nbsp;</p>

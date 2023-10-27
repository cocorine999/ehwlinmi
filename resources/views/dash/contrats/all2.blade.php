@extends('layouts.dash')
@section('pagetitle', "Liste Globale des contrats")

@section('content')
<div>
  <div class="card filterbox">
    <div class="card-body statut" id="position">
      @foreach ($statuts as $s)
      <input type="checkbox" name="pos" class="" value="{{$s->label}}">{{$s->label}}<span class="mr-4"></span>
      @endforeach

      {{-- <input type="checkbox" name="retard" class="" value="0">Non Retard<span class="mr-4"></span>
      Primes
      <select name="primes" id="">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
      </select> --}}
    </div>

    <div class="card-body">
      @include('dash.components.lc', ['contrats' => $contrats ])
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready( function () {
$.fn.dataTable.ext.search.push(
function( settings, searchData, index, rowData, counter ) {
var status = $('input:checkbox[name="pos"]:checked').map(function() {
//alert(this.value);
return this.value;
}).get();

if (status.length === 0) {
return true;
}
if (status.indexOf(searchData[6]) !== -1) {
return true;
}
return false;
}
);


// $.fn.dataTable.ext.search.push(
// function( settings, searchData, index, rowData, counter ) {

// // var offices = $('select option:selected').map(function() {
// // return this.selectedIndex(2);
// // }).get();

// var offices = []
// $.each($("select option:selected"), function(i, opt) {
// offices.push(opt.textContent[1])
// console.log(opt.textContent)
// })

// //console.log(offices, searchData[5]);
// if (offices.length === 0) {
// return true;
// }

// if (offices.indexOf(searchData[5]) !== -1) {
// return true;
// }

// return false;
// }
// );

var table = $('#example1').DataTable();

$('input:checkbox').on('change', function () {
table.draw();
});

} );
</script>

@endsection

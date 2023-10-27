@if (Session::has('success'))
	<div class="container" style="margin-top: 20px;">
		<div class="row">
	  	<div class="col-10 mx-auto alert alert-success {{ Session::get('action')? 'float-right' : 'text-center' }}" role="alert" data-dismmiss="alert">
    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>
				<strong>{{ Session::get('success')}}</strong>
				@if(Session::get('action'))
					<hr>
					<a href="{{ route(Session::get('action')) }}" class="btn btn-xs btn-success float-right">Continuer</a>
				@endif
	  	</div>
		</div>
	</div>
@endif

@if (Session::has('error'))
	<div class="container" style="margin-top: 20px;">
		<div class="row">
	  	<div class="col-10 mx-auto alert alert-danger {{ Session::get('action')? 'float-right' : 'text-center' }}" role="alert" data-dismmiss="alert">
    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>
				<strong>{{ Session::get('error')}}</strong>
				@if(Session::get('action'))
					<hr>
					<a href="{{ route(Session::get('action')) }}" class="btn btn-xs btn-danger float-right">Continuer</a>
				@endif
	  	</div>
		</div>
	</div>
@endif

@if (Session::has('warning'))
	<div class="container" style="margin-top: 20px;">
		<div class="row">
	  	<div class="col-10 mx-auto alert alert-warning {{ Session::get('action')? 'float-right' : 'text-center' }}" role="alert" data-dismmiss="alert">
    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>
				<strong>{{ Session::get('warning')}}</strong>
				@if(Session::get('action'))
					<hr>
					<a href="{{ route(Session::get('action')) }}" class="btn btn-xs btn-warning float-right">Continuer</a>
				@endif
	  	</div>
		</div>
	</div>
@endif

@if (Session::has('info'))
	<div class="container-fluid" style="margin-top: 20px;">
		<div class="row">
	  	<div class="col-10 mx-auto alert alert-info text-center" role="alert" data-dismmiss="alert">
    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>
				<a href="{{ route(Session::get('action')) }}" class="btn btn-xs btn-primary pull-right">Continuer</a>
	    	<strong>{{ Session::get('info')}}</strong>
	  	</div>
		</div>
	</div>
@endif

@if(count($errors)>0)
	<div class="container-fluid" style="margin-top: 20px;">
		<div class="row">
	  	<div class="col-10 mx-auto alert alert-danger" role="alert" data-dismmiss="alert">
    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>
	  		</ul>
		  		@foreach ($errors->all() as $error)
		    		<li><strong>{{ $error }}</strong></li>
		    	@endforeach
	    	</ul>
	  	</div>
		</div>
	</div>
@endif

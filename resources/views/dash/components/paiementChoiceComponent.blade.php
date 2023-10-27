				{{--
				@role(config('custom.roles.marchand'))
				<div class="row mt-4">
					<p class="col-12">Effectuer le paiement depuis: </p>
					<div class="col-md-6">
						<input type="radio" name="paiementSource" value="selfaccount" id="choixSelf" required="required"> 
						<label for="choixSelf">Mon compte<br>
						</label>
					</div>
					<div class="col-md-6">
						<input type="radio" name="paiementSource" value="clientaccount" id="choixClient" required="required"> 
						<label for="choixClient">Compte du Souscripteur<br>
						</label>
					</div>
				</div>
				@endrole
				--}}

				<div class="row mt-4">
					<div class="col-md-6">
						<input type="radio" name="paiementChoice" value="MTN" id="choixMTN" required="required"> 
						<label for="choixMTN">MTN Mobile Money <br>
						<img src="{{ asset('mtn.jpeg') }}" class="img-responsive" alt="MTN Mobile Money" style="width: 100px; height: 100px;">
						</label>
					</div>
					<div class="col-md-6">
						<input type="radio" name="paiementChoice" value="MOOV" id="choixMOOV" required="required"> 
						<label for="choixMOOV">Moov Money Flooz <br>
						<img src="{{ asset('moov.jpeg') }}" class="img-responsive" alt="Moov Money Flooz" style="width: 100px; height: 100px;">
						</label>
					</div>
				</div>
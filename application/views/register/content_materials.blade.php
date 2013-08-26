<div>
	<div id="materials_head">
		<a href="{{ URL::home() }}"><div id='r_logo'></div></a>
		<div id="steps_words">
			<div>Step 1: Registering</div>
			<div>Step 2: Basic Information</div>
			<div>Step 3: Adding materials</div>
		</div>
		<div class="clr"></div>
		<div id="steps">
			<div id="l_step1"></div>
			<div id="l_step2"></div>
			<div id="l_step3"></div>
		</div>
	</div>
	<div class="clr"></div>
	<form action="{{ URL::to('register/finished') }}" id="login_form" method="POST" enctype="multipart/form-data">
		<div id="step3">
			<h2>Adding materials</h2>
				
			<div id="table">
				<div class="h_row">
					<div class="t_box0" style="color:#DDD">
						Material no.
					</div>
					<div class="t_box1">
						Material name <small style="color:#F25050">( in English )</small>
					</div>
				</div>

				<div class="clr"></div>

				@for($i = 0; $i <= 6; $i ++)
				@if(isset($materials[$i]))
					<input type="hidden" name="materials_id[]" value="{{ Hash::encode($materials[$i]->id) }}" />
				@else
					<input type="hidden" name="materials_id[]" value="{{ Hash::encode(0) }}" />
				@endif
				<div class="t_row">
					<div class="t_box0" <? if(isset($materials[$i]))echo 'style="color:#DDD"' ?>>
						{{ $i + 1 }}
					</div>
					<div class="t_box1">
						<input type="text" name="material_name[]" value="<? if(isset($materials[$i]))echo $materials[$i]->name; ?>" id="r_material_name" class="txt" />
					</div>
				</div>
				@endfor

			</div><!-- END of #table --> 

			<div class="clr"></div>

			<input type="submit" id="sbmt4" class="sbmt" Value="Finish and go to home page ►" />
		</div><!-- END of #step3 -->
	</form>
</div>
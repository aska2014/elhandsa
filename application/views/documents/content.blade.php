<div id="big_content">
	<style type="text/css">
		#accordion ul li a{color:#33ade1;}
		#accordion ul li{margin-left:30px;}
	</style>
	<div id="accordion" style="margin:0px auto; margin-bottom:50px; width:60%;">
		@foreach($materials as $material)
		<h3><a href="#section1">{{$material->name}}</a></h3>
		<div>
			@if(empty($material->documents))
				<div class="error">No documents have been uploaded for this mateiral yet</div>
			@endif 
			<ul>
				@foreach($material->documents as $document)
					<li><a href="{{ $document->file_url }}" target="_blank">{{ $document->name }}</a></li>
				@endforeach
			</ul>
		</div>
		@endforeach
	</div>
</div>

<div class="clr" style="height:100px;"></div>
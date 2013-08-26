@layout('master.master1')

@section('content')

	@if($display == 'enable_javascript')

		@include('help.enable_javascript')

	@elseif($display == 'faq')

		@include('help.faq')

	@elseif($display == 'videos')

		@include('help.videos')
		
	@endif

@endsection
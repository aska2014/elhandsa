@layout('master.master1')

@section('content')
	@if(isset($view) && $view == "doctors")
		@include('register.content_doctors')
	@elseif(isset($view) && $view == "materials")
		@include('register.content_materials')
	@else
		@include('register.content')
	@endif
@endsection

@section('scripts')
	@if(isset($view) && $view == "materials")
		@include('register.scripts_materials')
	@else
		@include('register.scripts')
	@endif
@endsection
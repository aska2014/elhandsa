@layout('master.master')

@section('content')
	@include('home.content')
	@include('home.right_panel')
@endsection

@section('scripts')
	@include('home.scripts')
@endsection
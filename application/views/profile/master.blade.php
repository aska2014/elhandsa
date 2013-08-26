@layout('master.master')

@section('styles')
	{{ HTML::style('public/css/profile.css') }}
@endsection

@section('content')
	@if(isset($display) && $display == "edit")
		@include('profile.edit')
	@else
		@include('profile.design1')
	@endif
@endsection

@section('scripts')
	@include('profile.scripts')
@endsection
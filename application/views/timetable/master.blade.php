@layout('master.master')

@section('styles')
	{{  HTML::style('public/css/timetable.css') }}
@endsection

@section('content')
	@include('timetable.content')
	@if(isset($display) && $display == 'add')
		@include('timetable.add')
	@endif
@endsection

@section('scripts')
	@include('timetable.scripts')
@endsection
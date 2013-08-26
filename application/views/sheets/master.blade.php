@layout('master.master')

@section('styles')
	{{  HTML::style('public/css/timetable.css') }}
@endsection

@section('content')
	@include('sheets.content')
@endsection
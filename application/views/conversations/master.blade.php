@layout('master.master')

@section('styles')
	{{ HTML::style('public/css/conversations.css') }}
@endsection

@section('content')
	@if(isset($display) && $display == 'conversation')
		@include('conversations.conversation')
	@else
		@include('conversations.main')
	@endif
@endsection

@section('scripts')
	@if(isset($display) && $display == 'conversation')
		@include('conversations.scripts')
	@endif


	{{ HTML::style('public/plugins/chosen/chosen.css') }}
	{{ HTML::script('public/plugins/chosen/chosen.jquery.min.js') }}

	<script type="text/javascript">

		$(document).ready(function() {
			
			$("#members_type").change(function() {
				jq_form = $("#users");

				var position = jq_form.offset();
				var e_width  = jq_form.width();
				var e_height = jq_form.height();
				$("body").append('<div class="loading" style="position:absolute; left:' + (position.left + (e_width / 2) - 20) + 'px; top:' + (position.top + (e_height / 2) - 20) + 'px;"></div>');
				
				jq_form.fadeTo(500,0.3);
				
				$.ajax({
					cache:false,
					url:  "{{ URL::to('conversations/') }}" + $(this).val(),
					type: "GET",
					success:function(d) {
						$("#users").html(d);
						$(".loading").remove();
						jq_form.fadeTo(500, 1);
					}
				});
			});
		});
		$(".chzn-select").chosen(); 
		$(".chzn-select-deselect").chosen({allow_single_deselect:true});

	</script>

@endsection
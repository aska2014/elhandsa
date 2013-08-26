<div id="content">

	@if(!empty($notifications))
	<div id="notifications">
		<h2 class="has_notifications">Notificaitons</h2>
		@foreach($notifications as $notification)
		<div class="complete">
			@if($notification instanceOf Notification)
				<div class="close"></div>
				<input type="hidden" id="not_type" value="{{ $notification->type }}" />
				<input type="hidden" id="not_id"   value="{{ $notification->id }}" />
				{{ $notification->body }}
			@else
				{{ $notification }}
			@endif
		</div>
		@endforeach
	</div>
	@else
		<div style="height:20px;"></div>
	@endif

	<div class="error">{{ echoHTML::echo_errors($errors) }}</div>

	<div class="clr"></div>

	<div class="viewport">

		@if(!Auth::user()->isdoctor() && !Auth::user()->isprofessor())
			<div id="show_by">
				<B >Show :</B>
				<a <? if($posts_type == 0)echo 'class="active" ' ?>href="{{ URL::to('home/students') }}">Students Posts</a> or
				<a <? if($posts_type == 1)echo 'class="active" ' ?>href="{{ URL::to('home/instructors') }}">Instructors Posts <? if($instructors_not)echo '<sup>NEW</sup>';?></a> 
			</div>
		@else
			<div id="show_by">
				Welcome back, {{Auth::user()->who().' <font color="#F25050">'.Auth::user()->name()}}</font><br />
				You are currently in <font color="#2E7C9C">{{ Auth::user()->group->department }}</font> department, <font color="#2E7C9C">{{ Auth::user()->group->year() }}</font> year.<br />
				► You can always change the group by <a href="{{ URL::to('group/choose') }}">clicking here</a>
			</div>
		@endif

		<form action="{{ URL::to('home/add_post') }}" method="POST" id="post_form" class="form">
			<textarea class="txt" name="body" id="post_body" onfocus="if(this.value == '{{ $add_post_textarea }}')this.value='';" onblur="if(this.value == '')this.value = '{{ $add_post_textarea }}';">{{ $add_post_textarea }}</textarea>
			<input type="hidden" name="type" id="post_type" value="{{ $posts_type }}" />
			<input type="submit" class="sbmt" value="Post" />
		</form>
		<div class="clr"></div>

		<div id="posts">
			<hr />
			@foreach($posts as $post)
				<div class="post" id="post{{ $post->id }}">
					@if($post->member_id == Auth::user()->id)
						<div class="delete" id="delete{{ Hash::encode($post->id) }}"></div>
					@endif
					<div class="img">
						<a href="{{ $post->member->profile() }}">
							<img src="{{ $post->member->img() }}" />
						</a>
					</div>
					<div class="post_info">
						<div class="mem_name"><A href="{{ $post->member->profile() }}">{{ $post->member->name() }}</a></div>
						<div class="post_body">{{ $post->body }}</div>
						<div class="tools">
							@if($post->iLikeExist())
								<span class="date">{{ $post->date() }}</span>
							@else
								<a href="javascript:void(0)" class="like_btn" id="like{{ Hash::encode($post->id) }}">Like</a> - <span class="date">{{ $post->date() }}</span>
							@endif
						</div>
					</div>
					<div class="clr"></div>
					<div class="comments" id="comments{{ $post->id }}">
						@if(count($post->likes()) > 0)
							<div class="members_show_likes" id="members_show_likes{{ $post->id }}">
								@foreach($post->likes() as $like_member)
									{{ $like_member->name() }}<Br />
								@endforeach
							</div>
							<div class="comment" id="post_likes"><a href="javascript:void(0)" class="show_likes" id="show_likes{{ $post->id }}"><span>{{count($post->likes())}}</span> people</a> like this</div>
						@endif

						@if(count($post->comments) > 4)
						<div class="comment"><a class="view_all" href="javascript:void(0)" id="{{ $post->id }}">View all {{ count($post->comments) }} comments</a></div>
						@endif
						<? $i = count($post->comments); ?>
						@foreach($post->comments as $comment)
							<? $i-- ?>
							<div class="comment" <? if($i > 3)echo 'style="display:none"'; ?> id="comment{{ $comment->id }}">
								<div class="img">
									<a href="{{ $comment->member->profile() }}">
										<img src="{{ $comment->member->img() }}" />
									</a>
								</div>
								<div class="c_info">
									<div class="c_body"><span class="mem_name"><A href="{{ $comment->member->profile() }}">{{ $comment->member->name() }}</a></span>
														{{ $comment->body }}</div>
									<div class="tools">
										<span class="date">{{ $comment->date() }}</span>
									</div>
								</div>
								<div class="clr"></div>
							</div><!-- END of .comment -->
							<div class="clr"></div>
						@endforeach

						<form id="comment_form" class="form comment_form" action="{{ URL::to('home/add_comment') }}" method="POST">
							<textarea name="body" id="comment_body{{ $post->id }}" class="txt" onfocus="if(this.value == 'Write a comment...')this.value = '';" onblur="if(this.value == '')this.value = 'Write a comment...';">Write a comment...</textarea>
							<input type="submit" class="sbmt" value="Add Comment" />
							<input type="hidden" name="post_id" id="post_id" value="{{ Hash::encode($post->id) }}" />
						</form>
					</div><!-- END of .comments -->
					<div class="clr"></div>
				</div><!-- END of .post -->
				<hr />
			@endforeach
		</div><!-- END of .posts -->
	</div><!-- END of .viewport -->

</div>
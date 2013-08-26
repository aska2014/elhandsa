<?php

class echoHTML {

	public static function echo_post($post)
	{
		$format  = '<hr />';
		$format .= '<div class="post" style="display:none;" id="post'.$post->id.'">';
		$format .= '	<div class="delete" id="delete'.$post->id.'"></div>';
		$format .= '	<div class="img">';
		$format .= '		<a href="'.$post->member->profile().'">';
		$format .= '			<img src="'.$post->member->img().'" />';
		$format .= '		</a>';
		$format .= '	</div>';
		$format .= '	<div class="post_info">';
		$format .= '		<div class="mem_name"><a href="'.$post->member->profile().'">'.$post->member->name().'</a></div>';
		$format .= '		<div class="post_body">'.$post->body.'</div>';
		$format .= '		<div class="tools"><span class="date">'.$post->date().'</span></div>';
		$format .= '	</div>';
		$format .= '	<div class="clr"></div>';
		$format .= '	<div class="comments" id="comments'.$post->id.'">';
		$format .= '		<form id="comment_form" class="form comment_form" action="'.URL::to('home/add_comment').'" method="POST">';
		$format .= '			<textarea name="body" id="comment_body'.$post->id.'" class="txt" onfocus="if(this.value == \'Write a comment...\')this.value = \'\';" onblur="if(this.value == \'\')this.value = \'Write a comment...\';">Write a comment...</textarea>';
		$format .= '			<input type="submit" class="sbmt" value="Add Comment" style="display:inline" />';
		$format .= '			<input type="hidden" name="post_id" id="post_id" value="'.Hash::encode($post->id).'" />';
		$format .= '		</form>';
		$format .= '	</div><!-- END of .comments -->';
		$format .= '	<div class="clr"></div>';
		$format .= '</div><!-- END of .post -->';
		$format .= '<hr />';

		return $format;
	}

	public static function echo_comment($comment)
	{
		$format  = '<div class="comment" style="display:none" id="comment'.$comment->id.'">';
		$format .= '	<div class="img">';
		$format .= '		<a href="'.$comment->member->profile().'"><img src="'.$comment->member->img().'" /></a>';
		$format .= '	</div>';
		$format .= '	<div class="c_info">';
		$format .= '		<div class="c_body">';
		$format .= '			<span class="mem_name"><a href="#">'.$comment->member->name().'</a></span> '.$comment->body;
		$format .= '		</div>';
		$format .= '		<div class="tools">';
		$format .= '			<span class="date">'.$comment->date().'</span>';
		$format .= '		</div>';
		$format .= '	</div>';
		$format .= '	<div class="clr"></div>';
		$format .= '</div>';
		$format .= '<div class="clr"></div>';

		return $format;
	}

	public static function echo_errors($errors)
	{
		if(isset($errors))
			return implode("<br />" ,is_object($errors)? $errors->all():(array)$errors);
	}

	public static function echo_message($message)
	{
		$format = '<div class="message">';
		$format .= '	   <div class="img">';
		$format .= '	    	<a href="'.$message->member->profile().'">';
		$format .= '				<img src="'.$message->member->img().'" />';
		$format .= '         </a>';
		$format .= '    </div>';
		$format .= '    <div class="message_info">';
		$format .= '	    <div class="mem_name"><A href="'.$message->member->profile().'">'.$message->member->name().'</a></div>';
		$format .= '      	<div class="post_body">'.$message->body.'</div>';
		$format .= '        <div class="tools">';
		$format .= '               <span class="date">'.$message->date().'</span>';
		$format .= '         </div>';
		$format .= '    </div>';
	    $format .= '</div>';
	    $format .= '<Hr /> <div class="clr"></div>';

	    return $format;
	}


	public static function echo_conversation_members_list($members)
	{
		$format = '<div>';
		foreach($members as $member):
			$format .= '<div class="member" onclick="javascript:window.location.href = \''.URL::to('conversation/'.$member->name_url()).'\'">';
			$format .= '	<div class="img"><img src="'.$member->img().'" /></div>';
			$format .= '	<div class="mem_name">'.$member->name().'<sup style="color:#F00">';
			if(count(Notifications::get_member_not_seen_messages($member->id)) > 0) $format .= ' NEW';
			$format .= '                                             </sup></div>';
			$format .= '    <div class="clr"></div>';
			$format .= '</div>';
			$format .= '<hr />';
			$format .= '<div class="clr"></div>';
		endforeach;
		$format .= '</div>';

		return $format;
	}

	public static function echo_online_members($members)
	{
		$format = '';
		foreach ($members as $member) {
			$format .= '<div class="online_member">';
			$format .= '	<a href="'.$member->profile().'">';
			$format .= '		<img title="'.$member->name().'" src="'.$member->img('_th').'">';
			$format .= '	</a>';
			$format .= '</div>';
		}

		return $format;
	}


	public static function echo_timetable($days)
	{
		$format = '';
		foreach((array)$days as $day):
			$lectures = Lecture::day($day['day']);
			if($lectures):
				Lecture::$precentage = 80.2;
				$last_end_at = 8;
				$format .= '<div class="row">';
				$format .= '	<div class="day_name">'.$day['day'].' <br /> <span style="font-size:12px; color:#2e7c9c">'.date('j F', $day['timestamp']).'</span></div>';
				$format .= '	<div class="table">';
					foreach(Lecture::day($day['day']) as $lecture):
						$format .= '<div title="'.$lecture->material->name.'" style="width:'. $lecture->width().'px; margin-left:'. $lecture->marginLeft($last_end_at).'px;" class="box '.$lecture->type .' '.$lecture->getState() .'" id="lecture'.$lecture->id.'">';
						$format .= '	<h2>'.Algorithms::cutText($lecture->material->name, $lecture->width(Lecture::$precentage) / 9).'</h2>';
						$format .= '    <div class="time">'. $lecture->start_at.' '.$lecture->session.'</div>';
						$format .= '</div>';
						$format .= '<div class="box_info" style="margin-left:'.$lecture->marginLeft($last_end_at).'px;">';
						$format .= '	<div class="delete"></div>';
						$format .= '	<div class="box_row">Start at : <span>'.$lecture->start_at.'</span></div>';
						$format .= '	<div class="clr"></div>';
						$format .= '	<div class="box_row">End at : <span>'.$lecture->end_at.'</span></div>';
						$format .= '	<div class="clr"></div>';
						$format .= '	<div class="box_row">Place : <span>'.$lecture->place.'</span></div>';
						if($lecture->getState() == "canceled"):
							$format .= '<div class="clr"></div>';
							$format .= '<div class="box_row">State : <span>Canceled</span></div>';
						endif;
						$format .= '	<div class="clr"></div>';
						$format .= '	<hr />';
						$format .= '	<div class="delete_row" id="delete'.Hash::encode($lecture->id).'">';
						$format .= '		<div class="delete_red" ></div>';
						$format .= '		<div class="delete_label">Delete '.$lecture->type.'</div>';
						$format .= '	</div>';
						$format .= '</div>';
						$last_end_at = $lecture->getEndAt24();
					endforeach;
				$format .= '	</div>';
				$format .= '</div>';
				$format .= '<div class="clr"></div>';
			endif;
		endforeach;
		return $format;
	}

}
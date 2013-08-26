<?php

class Notifications {

	public static function get_new_instructors()
	{
		$posts = Post::where('group_id', '=' , Auth::user()->group_id)
					 ->where('type'    , '!=', "0")
					 ->order_by('created_at', 'desc')
					 ->get();
		$last_post_id = 0;
		foreach ($posts as $post) {
			if($post->member->type != "0")
			{
				$last_post_id = $post->id;
				break;
			}
		}
		$last_instructors_post_id = Cookie::get('instructors_not');
		if(is_null($last_instructors_post_id) && $last_post_id)
			return true;
		if($last_post_id > intval($last_instructors_post_id))
			return true;
		return false;
	}

	public static function doSeeInstructors()
	{
		$posts = Post::where('group_id', '=' , Auth::user()->group_id)
					 ->where('type'    , '!=', "0")
					 ->order_by('created_at', 'desc')
					 ->get();
		$last_post_id = 0;
		foreach ($posts as $post) {
			if($post->member->type != "0")
			{
				$last_post_id = $post->id;
				break;
			}
		}
		setcookie('instructors_not', $last_post_id, time() + Date::DaystoSeconds(5), '/'); 
	}

	public static function get_messages() {
		return Message::where('to_id', '=', Auth::user()->id)
			          ->where('seen' , '=', 0)
			          ->get();
	}

	public static function get_member_not_seen_messages($member_id) {
		return Message::where('to_id'    , '=' , Auth::user()->id)
					  ->where('member_id', '=' , $member_id)
			          ->where('seen'     , '=' , 0)
			          ->get();
	}

	/**
	 * @return Notification || null
	 */
	public static function do_get($type) {
		$last_cookie    = Cookie::get($type.'_not');
		$last_timetable = Notification::get_last($type);

		if(is_null($last_cookie) || is_null($last_timetable) || $last_cookie < $last_timetable->id)
			return $last_timetable;
		return null;
	}

	/**
	 * Return if exists complete your registeration
	 * @return String || false
	 */
	public static function complete_registeration() {
		$member = Auth::user();

		$string = false;
		if($member->cell_phone == '' || $member->home_town == '' || !$member->birthday())
		{
			$string  = 'You haven\'t completed your information yet<br />';
			$string .= '<a href="'.URL::to('profile/edit').'">Click here</a> to complete your profile information';
		}

		return $string;

	}

	/**
	 * Return if exists any group not completed info ( timetable, materials )
	 * @return String || false
	 */
	public static function complete_group_info() {
		$group = Auth::user()->group;

		$string = false;

		if(count($group->materials) < 5)
		{
			$string .= 'Your group hasn\'t finished adding materials yet, ';
			$string .= '<a href="'.URL::to('register/add_materials').'">Click here</a> to finish adding materials.<br />';
		}

		if(is_null($group->timetable))
		{
			$string .= 'Your group hasn\'t addded a timetable yet, ';
			$string .= '<a href="'.URL::to('timetable/update').'">Click here</a> to add one.<br />';
		}

		return $string;
	}

	public static function home_notifications() {
		$array = array();
		if(self::complete_registeration()) array_push($array, self::complete_registeration());
		if(self::complete_group_info())    array_push($array, self::complete_group_info());
		if(self::do_get('timetable'))	   array_push($array, self::do_get('timetable'));
		if(self::do_get('sheet'))	   	   array_push($array, self::do_get('sheet'));
		if(self::do_get('document'))	   array_push($array, self::do_get('document'));

		return $array;
	}

	public static function count_not_home_notifications() {
		$i = 0;
		if(self::do_get('timetable'))$i++;
		if(self::do_get('sheet'))	 $i++;
		if(self::do_get('document')) $i++;
		if(self::get_messages())$i ++;
		return $i;
	}

	public static function doSee($type)
	{
		$last_timetable_not = self::do_get($type);
		if(!is_null($last_timetable_not))
			// store for 5 days, We know that notification will be deleted after 4 days
			setcookie($type.'_not', $last_timetable_not->id, time() + Date::DaystoSeconds(5), '/'); 
	}

}
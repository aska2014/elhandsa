
<?php

class Test_Controller extends Controller{

	public $restful = true;

	public function __construct()
	{
		if(Auth::guest() || Auth::user()->id != 1)exit();
	}


	public function get_add_up_not()
	{
		echo '<form method="POST">';
		echo '<input type="text" name="title" /><br />';
		echo '<textarea name="body"></textarea><br />';
		echo '<input tye="text" name="group_id" /><br />';
		echo '<input type="checkbox" name="all" />';
		echo '<input type="submit" />';
		echo '</form>';
		exit();
	}

	public function post_add_up_not()
	{
		$input = Input::all();
		$notifications = Notification::where_type('up_not')->get();
		foreach ($notifications as $notification) {
			$notification->delete();
		}


		if(isset($input['all']))
		{
			$groups = Group::all();
			foreach ($groups as $group) {
				$notification = new Notification;
				$notification->group_id = $group->id;
				$notification->title    = $input['title'];
				$notification->body     = $input['body'];
				$notification->type     = "up_not";
				$notification->save();
			}
		}
		else
		{
			$notification = new Notification;
			$notification->group_id = $input['group_id'];
			$notification->title    = $input['title'];
			$notification->body     = $input['body'];
			$notification->type     = "up_not";
			$notification->save();

		}
	}


	function action_add_passwords()
	{
		// for ($i=0; $i < 5; $i++) { 
		// 	$groups = Group::where_year($i)->get();
		// 	$rand = rand(1000,9999);
		// 	foreach ($groups as $group) {
		// 		$group->password = $rand;
		// 		$group->save();
		// 	}
		// }
	}
}
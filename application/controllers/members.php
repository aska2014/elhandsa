<?php

class Members_Controller extends Base_Controller {

	public function action_index($year = 10) {
		if($year == 10)$year = Auth::user()->group->year;

		$groups = Group::where('year', '=', $year)->get();

		return View::make('members.master')->with('groups', $groups);
	}

}
<?php

class Group_Controller extends Base_Controller {
	
	public $restful = true;

	public function get_choose($errors = null)
	{
		$departments = Group::where_year(1)->get();
		$preparatory_departments = Group::where_year(0)->get();

		return View::make('group.master')->with('title'                  , 'Welcome to Elhandsa Dr.'.Auth::user()->name())
										 ->with('departments'            , $departments)
										 ->with('preparatory_departments', $preparatory_departments)
										 ->with('errors', $errors);
	}

	public function post_choose(){
		$input = Input::all();

		if($input['preparatory_department'] != "")
			$department = $input['preparatory_department'];
		else
			$department = $input['department'];
		
		$group = Group::where_year_and_department($input['year'], $department)->first();

		if(!is_null($group))
		{
			/**
			 * Save a cookie forever if save selection is checked or else for 3 hours
			 */
			if(isset($input['save_selection']))
				Cookie::forever('save_selection', 'yes');
			else
				Cookie::put    ('save_selection', 'yes', 60*3);

			$member = Auth::user();
			$member->group_id = $group->id;
			$member->save();
			return Redirect::home();
		}
		else
		{
			return $this->get_choose(array('You have to choose both the year and department'));
		}
	}

}
<?php

class Timetable_Controller extends Base_Controller{

	public $restful = true;
	private $days = array();

	public function __construct()
	{
		parent::__construct();
		if(is_null(Auth::user()->group->timetable))
			$this->days = null;
		else
			$this->days = Auth::user()->group->timetable->days();

		Notifications::doSee('timetable');
	}

	public function get_index()
	{
		$view = MyView::make('timetable.master');

		$view->days = $this->days;

		return $view;
	}

	public function get_update()
	{
		$timetable = Auth::user()->group->timetable;
		if(is_null($timetable))$timetable = new Timetable;
		$timetable->group_id = Auth::user()->group_id;
		$timetable->save();
		
		return MyView::make('timetable.master')->with('display'   , 'add')
											   ->with('days'      , Date::days())
											   ->with('step'      , 1)
											   ->with('timetable' , $timetable);
	}

	public function get_update_day($day, $increments = 0)
	{
		$view = $this->get_index();
		
		// Get current day index if exists
		foreach ($this->days as $key => $day_combined) {
			if($day == $day_combined['day'])
			{
				$day_key = $key;
				break;
			}
		}
		if($day_key === FALSE || !isset($this->days[$day_key + $increments]['day']))
			return $this->get_index();
		
		$view->display   = 'add';
		$view->step      = 2;
		$view->day       = $this->days[ $day_key + $increments ]['day'];
		$view->materials = Auth::user()->group->materials;
		$view->days      = $this->days;

		return $view;
	}

	public function post_update()
	{
		$input = Input::all();
		$rules = array(
			'start_at' => 'required|in:'.implode(",", Date::days()),
			'end_at' => 'required|in:'.implode(",", 	 Date::days()));

		$validation = Validator::make($input,$rules);
		if($validation->fails())
		{
			return Redirect::to('timetable/update')->with_errors($validation->errors->all());
		}
		else
		{
			$timetable = Auth::user()->group->timetable;
			$timetable->days_start_at = $input['start_at'];
			$timetable->days_end_at   = $input['end_at'];
			$timetable->save();

			return Redirect::to('timetable/update_day/'.$input['start_at'].'#timetable_form');
		}
	}

	public function post_update_day($day)
	{
		$input = Input::all();
		$input['start_at'] = str_replace(":", ".", $input['start_at']);
		$input['end_at']   = str_replace(":", ".", $input['end_at']);

		$rules = array(
			'material_id' => 'required|exists:materials,id',
			'day'         => 'required',
			'type'        => 'required|in:lecture,section',
			'start_at'    => 'required|numeric',
			'end_at'      => 'required|numeric',
			'place'       => 'required'
			);
		
		if($input['start_at'] > 13 || $input['end_at'] > 13)
		{
			echo 'The values you entered for start at and\or end at are not valid';
			exit();
		}
		
		$validation = Validator::make($input , $rules);

		if($validation->fails())
		{
			$errors = implode("<br />", $validation->errors->all());
			echo $errors;
		}
		else
		{
			$lecture = new Lecture;
			$lecture->material_id = $input['material_id'];
			$lecture->day 		  = $input['day'];
			$lecture->start_at    = $input['start_at'];
			$lecture->end_at      = $input['end_at'];
			$lecture->place       = $input['place'];
			$lecture->type        = $input['type'];

			$a_lecture = $lecture->another_exists();
			if(!$a_lecture)
			{
				$lecture->save();
				echo 'success';
				echo echoHTML::echo_timetable($this->days);	
			}
			else if(isset($input['overwrite']) && $input['overwrite'] == "yes")
			{
				$a_lecture->delete();
				$lecture->save();
				echo 'success';
				echo echoHTML::echo_timetable($this->days);
			}
			else
			{
				$errors = 'There\'s '. $a_lecture->material->name .' '. $a_lecture->type .' in the same day and time.';
				$errors .= '<br />You can overwrite this lecture by checking the overwrite box.';
				echo $errors;
			}
		}
		if(Request::ajax())
		{
			exit();
		}else
			return Redirect::to('timetable/update_day/'.$day);
	}

	public function post_delete_lecture()
	{
		if(isset($_POST['lecture_id']))
		$lecture = Lecture::find(Hash::decode($_POST['lecture_id']));
		$lecture->delete();
		if(Request::ajax())
			echo "success".$lecture->id;
		else
			return Redirect::back();
		exit();
	}
}
<?php

class Instructors_Controller extends Base_Controller{

	public $restful = true;

	public function get_add_doctor()
	{
		return View::make('instructors.add')->with('instructors_type', '2')
											->with('instructor_who' , 'Doctor')
											->with('instructor_who_arabic', 'الدكتور');
	}

	public function get_add_professor()
	{
		return View::make('instructors.add')->with('instructors_type', '1')
											->with('instructor_who' , 'Professor')
											->with('instructor_who_arabic', 'المعيد');
	}

	public function post_add_doctor()
	{
		$input = Input::all();
		if($input['instructor_name'] == '')
 	    	return Redirect::to('instructors/add_doctor')->with_errors(array('You have to enter Doctor name'));

 	    $doctor              = new Instructor;
 	    $doctor->ar_name     = $input['instructor_name'];
 	    $doctor->ar_group    = Auth::user()->group->department_ar;
 	    $doctor->add_by_user = Auth::user()->id;
 	    $doctor->type        = 2;
 	    $doctor->save();

 	    return Redirect::to('register/add_materials');
	}

	public function post_add_professor()
	{
		$input = Input::all();
		if($input['instructor_name'] == '')
 	    	return Redirect::to('instructors/add_professor')->with_errors(array('You have to enter Professor name'));

 	    $professor              = new Instructor;
 	    $professor->ar_name     = $input['instructor_name'];
 	    $professor->ar_group    = Auth::user()->group->department_ar;
 	    $professor->add_by_user = Auth::user()->id;
 	    $professor->type        = 1;
 	    $professor->save();
 	    
 	    return Redirect::to('register/add_materials');
	}


}
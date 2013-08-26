<?php

class Register_Controller extends Base_Controller{


	public $restful = true;

	function get_index(){ return $this->get_students(); }
	function get_students()
	{
		if(!Auth::guest())return Redirect::to('register/add_materials');

		$departments = Group::where_year(1)->get();
		$preparatory_departments = Group::where_year(0)->get();
		return View::make('register.master')->with('departments', $departments)
											->with('preparatory_departments', $preparatory_departments)
											->with('title', 'Register as a student');
	}

	function get_doctors()
	{
		$doctors = Doctor::all();
		$materials = Material::all();
		return View::make('register.master')->with('view', 'doctors')
											->with('doctors', $doctors)
											->with('materials', $materials);
	}

	public function get_add_materials()
	{
		if(Auth::guest())return Redirect::to('register');

		//$instructors = Instructor::order_by('ar_name', 'ASC')->get();

		// Send group materials
		$materials = Auth::user()->group->materials;

		return View::make('register.master')->with('view'        , 'materials')	
											->with('title'       , 'Adding materials')
											->with('materials'   , $materials);
	}

	/*
	|
	| Handle the submitted forms, from students and doctors
	|
	*/

	public function post_index(){return $this->post_students();}
	public function post_students()
	{
		$input = Input::all();
		$input['department'] = ($input['year'] == '0')? $input['preparatory_department']:$input['department'];
		$rules = array(
			'email' => 'required|email|unique:members,email',
			'first_name' => 'required|min:3',
			'last_name' => 'required|min:3',
			'password' => 'required|min:7',
			'year' => 'required|exists:groups',
			'department' => 'required|exists:groups'
			);

		$messages = array(
		    'unique' => 'The email address has already been taken.',
		);

 	    $validation = Validator::make($input, $rules, $messages);
 	    if($validation->fails())
 	    {
 	    	return Redirect::to('register')->with_errors($validation);
 	    }
 	    else
 	    {
 	    	/*
 	    	| 1. Creating new member with defined group (if there were no members in group) 
 	    	| 2. Login this member and Redirect to add materials page
 	    	*/

 	    	//1.Creating new member with defined group
			$member = new Member;
			$member->email = $input['email'];
			$member->first_name = $input['first_name'];
			$member->last_name = $input['last_name'];
			$member->password = Hash::make($input['password']);
			$member->cell_phone = $input['cell_phone'];
			$member->home_town = $input['home_town'];
			// TODO:: remove this identity
			$member->identity = 100;
			if($input['birthday_day'] && $input['birthday_month'])
				$member->birthday = '1991-'.$input['birthday_month'].'-'.$input['birthday_day'];
			$group = Group::where_year_and_department($input['year'], $input['department'])->first();
			if($input['group_password'] != $group->password)
			{
				return Redirect::to('register')->with_errors(array('The group password is incorrect'));
			}
			$member->group_id = $group->id;
			$member->save();

			//2.Login this member
			$credentials = array('username' => $input['email'], 
								 'password' => $input['password'],
								 'remember' => isset($input['remember_me']));
			if(Auth::attempt($credentials))
			{
				return Redirect::to('register/add_materials');
			}
 	    }
	}

	public function post_doctors()
	{
		$input = Input::all();
		$rules = array(
			'doctor_id' => 'required|in:doctors, id',
			'materials' => 'required',
			'about' => 'required|min:10'
			);
		$validation = Validator::make($input, $rules, $messages);
 	    if($validation->fails())
 	    {
 	    	return Redirect::to('register/doctors')->with_errors($validation);
 	    }
 	    else
 	    {
 	    	$doctor = Doctor::find($input['doctor_id']);

 	    	$member = new Member;
 	    	$member->type = 2;
 	    	$member->group_id = 1;
 	    	$member->first_name = $doctor->first_name;
 	    	$member->last_name = $doctor->last_name;
 	    	$member->about = $input['about'];

 	    	/*
 	    	| Going through original and inputed materials and see how much they match
 	    	| Then calculating identity % DIVIDED BY 3‼
 	    	*/
 	    	$materials = explode(",",$input['materials']);
 	    	$i = 0;
 	    	foreach ($doctor->materials as $original_material) {
 	    		foreach ($materials as $input_material_id) {
 	    			if($original_material->id == $input_material_id)
 	    				$i++;
 	    		}
 	    	}
 	    	$identity = 100 - (count($materials) - $i) * (100 / count($materials));
 	    	$member->identity = (int)($identity / 3);
			/*
			|---------------------------------------------------------------------------
 	    	*/

 	    	$doctor->member->insert($member);

 	    	$view = View::make('message.master');
 	    	$view->title    = "Thanks for registeration dr. ". $member->name();
 	    	$view->message  = "As a way of protecting your identity, we will need a day or so to go through your info and confirm your identity.<br />";
 	    	$view->message .= "We will be sending you an email in the next two days to inform you with the next few steps to take to continue registeration and start connecting with your students and instructors.<br /><br />";
			$view->message .= "If you feel like starting today, you can send us a message <a href='#'>from here</a> so we could confirm your identity as fast as we get your message.";

			return $view;

  	    }
	}

	public function post_add_materials()
	{
		$input = Input::all();

		for($i = 0; $i < count($input['materials_id']); $i++)
		{
			if($input['material_name'][$i] == '')
				continue;

			$material_id = Hash::decode($input['materials_id'][$i]);
			if($material_id == "0") // New Material
			{
				$material = new Material;
				$material->group_id = Auth::user()->group_id;
			}
			else // Update existing material
			{
				$material = Material::find($material_id);
				// For security reasons
				if(is_null($material) || $material->group_id != Auth::user()->group_id)continue;
			}

			$material->name         = $input['material_name'][$i];
			$material->save();
		}
	}

	public function post_finished()
	{ 
		$this->post_add_materials();
		return Redirect::home();
	}
}
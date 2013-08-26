<?php

class Closed_Controller extends Controller {

	public $restful = true;
	public function get_index($success = false)
	{
		return View::make('closed.master')->with('success', $success);
	}

	public function post_index()
	{
		$input = Input::all();
		$rules = array(
			'email' => 'required|email|unique:closed,email'
			);
		$messages = array(
		    'unique' => 'The email address has already been saved.',
		);

 	    $validation = Validator::make($input, $rules, $messages);
 	    if($validation->fails())
 	    {
 	    	return Redirect::to('closed')->with_errors($validation);
 	    }
 	    else
 	    {
 	    	$closed = new Closed;
 	    	$closed->email = $input['email'];
 	    	$closed->mem_ip = Request::ip();
 	    	$closed->save();
 	    	return Redirect::to('closed/index/success');
 	    }

	}


}
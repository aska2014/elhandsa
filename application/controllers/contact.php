<?php

class Contact_Controller extends Controller{

	public $restful = true;
	public function get_index()
	{
		return View::make('contact.master');
	}

	public function post_index()
	{
		$input = Input::all();
		$rules = array(
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required');
		$validation = Validator::make($input, $rules);
		if($validation->fails())
		{
 	    	return Redirect::to('contact')->with_errors($validation);
		}
		else
		{
			$message = new Message;
			if(Auth::guest())
			{
				$message->member_id = 0;
				$message->body = 'Name : '.$input['name'].'<br />Email : '.$input['email'].'<br />'.$input['message'];
			}
			else
			{
				$message->member_id = Auth::user()->id;
				$message->body = $input['message'];
			}
			$message->to_id = 1;
			$message->save();

			$view = View::make('message.master');
			$view->m_title = "Your message has been send successfuly";
			$view->message = 'Your message has been successfuly send to <font color="#f25050" size="2">Kareem Mohamed</font>, <a href="'.URL::home().'">Click here</a> to return back home';
			return $view;
		}

	}
}
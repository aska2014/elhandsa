<?php

class Login_Controller extends Base_Controller{

	public $restful = true;

	function get_index()
	{
		return View::make('login.master')->with('title', 'Welcome to Elhandsa | Login or Sign up as Student or Instructor');
	}

	function post_index()
	{
		$remember = false;
		if(isset($_POST['remember']))$remember = true;
		$credentials = array('username' => $_POST['email'], 
							 'password' => $_POST['password'],
							 'remember' => $remember);

		if (Auth::attempt($credentials))
		{
		     return Redirect::home();
		}
		else
		{
			$view = $this->get_index();
			$view->login_errors = "Email and/or password are incorrect";
			return $view;
		}
	}

}
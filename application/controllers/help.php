<?php

class Help_Controller extends Base_Controller {

	function action_enable_javascript()
	{
		return View::make('help.master')->with('display', 'enable_javascript');
	}


	function action_faq()
	{
		return View::make('help.master')->with('display', 'faq');
	}

	function action_videos()
	{
		setcookie('seen_help', 'true', time() + Date::DaystoSeconds(90), '/');
		return View::make('help.master')->with('display', 'videos');
	}

}
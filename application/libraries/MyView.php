<?php

class MyView extends View{

	public static function make($page, $data = array())
	{
		$view = parent::make($page, $data);

		$page = explode(".", $page);
		$page = $page[0];
		$view->menu_active = $page;

		/**
		 * Notifications
		 */
		if(URI::segment(1) != "conversations")
			$view->messages_not = count(Notifications::get_messages());
		else
			$view->messages_not = 0;

		if(Notifications::count_not_home_notifications() > 0)
			$view->title         = "El-Handsa (".Notifications::count_not_home_notifications().")";
		$view->timetable_not = Notifications::do_get("timetable");
		$view->sheet_not     = Notifications::do_get("sheet");
		$view->document_not  = Notifications::do_get("document");
		$view->up_not        = Notifications::do_get("up_not");
		$view->seen_help     = isset($_COOKIE['seen_help'])? true:false;
		if(URI::segment(2) == "instructors")
			$view->instructors_not = false; // true or false
		else
			$view->instructors_not = Notifications::get_new_instructors(); // true or false	
		Notifications::doSee('up_not');

		return $view;
	} 

}
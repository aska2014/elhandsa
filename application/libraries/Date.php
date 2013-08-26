<?php

class Date{

	/**
	 * Returns Sunday, Monday, etc..
  	 * @param date in this format 'mm/dd'
	 * @return string
	 */
	public static function get_day($date)
	{
		return date("l",strtotime($date));
	}

	/**
	 * Returns All days without friday
	 * @return array
	 */
	public static function days()
	{
		return array('Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thrusday');
	}

	public static function DaystoSeconds($days)
	{
		return $days * 24 * 60 * 60; 
	}

}
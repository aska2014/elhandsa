<?php

class Timetable extends Eloquent{

	/*
	| Defining Relationships
	*/
	public function group(){ return $this->belongs_to('Group'); }

	public function save()
	{
		$this->group_id = Auth::user()->group_id;
		parent::save();
	}

	/**
	 * Putting days from the start of the timetable to end of the timetable in an array with it's timestamps
	 * @return array
	 */ 
	public function days()
	{
		$tmp = false;
		$days = array();

		foreach ($this->getDaysInWeek() as $key => $value) {
			$day = date('l',$value);
			if(in_array($day, array($this->days_start_at, $this->days_end_at)))
			{
				if($tmp)
				{
					$tmp = FALSE;
					array_push($days, array('day' => $day, 'timestamp' => $value));
			}else $tmp = TRUE;
			}
			if($tmp)
				array_push($days, array('day' => $day, 'timestamp' => $value));
		}
		return $days;
	}

	function getDaysInWeek () {
	  if(date('l') != "Friday")
	  	$weekStart = strtotime('last Friday');
	  else
	  	$weekStart = strtotime('Today');
	  for ($i = 0; $i < 7; ++$i) {
	    $dayTimes[] = strtotime('+' . $i . ' days', $weekStart);
	  }
	  return $dayTimes;
	}

}
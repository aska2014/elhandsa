<?php

class Lecture extends Eloquent{

	public static $precentage; 

	/*
	| Defining Relationships
	*/
	public function material(){ return $this->belongs_to('Material'); }
	public function group()   { return $this->belongs_to('Group');    }

	public function name()
	{
		return $this->type.' '.$this->material->name;
	}

	/**
	* @overwrite parent save function 
	*/
	public function save()
	{
		if($this->start_at < 12.00 && $this->start_at > 7)
			$this->session = 'am';
		else
			$this->session = 'pm';
		$this->group_id = Auth::user()->group_id;

		parent::save();

		// Insert notification that this lecture is updated or canceled
		$notification = new Notification;
		$notification->title    = "TimeTable";
		if($this->state == "canceled")
		{
			$notification->body = "<b>".Auth::user()->name()."</b> has <span style='color:#F00'>canceled</span> ".$this->material->name." ".$this->type." at ". date("j F",strtotime($this->canceled_date));
		}
		else
		{
			$notification->body = "<b>".Auth::user()->name()."</b> has <span style='color:#F00'>updated</span> ".$this->material->name." ".$this->type;
		}
		$notification->type     = "timetable";
		$notification->save();
		setcookie('timetable_not', $this->id, time() + Date::DaystoSeconds(5),'/');
	}

	/**
	 * @param string $day
	 * @return objects array
	 */
	public static function day($day)
	{
		return Lecture::where_day_and_group_id($day, Auth::user()->group_id)
					  ->order_by('session', 'ASC')
					  ->order_by('start_at','ASC')->get();
	}

	public function delayed_exists()
	{
		$day = Date::get_day($this->delayed_date);
		return $this->another_exists($day);
	}

	/**
	* Check if the date of this lecture confilects with another lecture
	* @return Lecture or false
	*/
	public function another_exists($day = null)
	{
		if(is_null($day))$day = $this->day;
		$lectures = Lecture::where_day_and_group_id($day, Auth::user()->group_id)->get();
		foreach ($lectures as $lecture) {
			if(($lecture->start_at <= $this->start_at && $lecture->end_at > $this->start_at)
			|| ($lecture->start_at < $this->end_at && $lecture->end_at >= $this->end_at))
			{
				return $lecture;
			}
		}
		return false;
	}

	public function make24Decimal($time)
	{
		// Get decimal multiply it by ratio then put it back
		$decimal = $time - (int)$time;
		$decimal = $decimal * (100 / 60);
		$time    = (int)$time + $decimal;
		// At PM ( 1 to 7 ) add 12 hours
		if($time <= 7.00)
			return $time + 12;
		return $time;
	}

	public function getStartAt24() { return $this->make24Decimal($this->start_at); }
	public function getEndAt24  () { return $this->make24Decimal($this->end_at  ); }


	public function width()
	{
		$diff = $this->getEndAt24() - $this->getStartAt24();
		return $diff * self::$precentage;
	}
	public function marginLeft($previous_end_at)
	{
		return ($previous_end_at == 0)? 0:($this->getStartAt24() - $previous_end_at) * self::$precentage;
	}

	public function getState()
	{
		if($this->state == "canceled")
		{
			// Check if the canceled date is in the same week as of today
			$canceled_date_week = date('W', strtotime($this->canceled_date.' +3 day'));
			$current_date_week  = date('W', strtotime('+3 day'));
			if($canceled_date_week == $current_date_week)
			{
				return "canceled";
			}
		}
		else if($this->state == "delayed")
		{
			return "delayed";
		}
		return "normal";
	}
	
}
<?php

class Notification extends Eloquent {

	public static function get_last($type) 
	{
		return self::where   ('type'    , '=' , $type)
				   ->where   ('group_id', '=' , Auth::user()->group_id)
				   ->order_by('id', 'desc')
				   ->take    (1)
				   ->first   ();
	}

	public function save(){
		if(!isset($this->group_id))
			$this->group_id = Auth::user()->group_id;
		parent::save();
	}

}
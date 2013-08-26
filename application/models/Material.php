<?php

class Material extends Eloquent{
	
	/*
	| Defining Relationships
	*/
	public function group    (){ return $this->belongs_to('Group');     }
	public function doctor   (){ return $this->belongs_to('Doctor');    }
	public function professor(){ return $this->belongs_to('Professor'); }
	public function lectures (){ return $this->has_many('Lecture');     }
	public function documents(){ return $this->has_many('Document');    }
	public function sheets   (){ return $this->has_many('Sheet');       } 

	/**
	* Used to see if this user can edit or add this object.
	* @return boolean
	*/
	public function access()
	{
		return ($this->group_id == Auth::user()->group_id || Auth::user()->type != 0);
	}

	public function save()
	{
		if($this->access())
			return parent::save();
	}

	public function edit()
	{
		if($this->access())
			return parent::save();
	}

}
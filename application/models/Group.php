<?php

class Group extends Eloquent{
	
	/*
	| Defining Relationships
	*/
	public function members  (){ return $this->has_many('Member');   }
	public function posts    (){ return $this->has_many('Post');     }
	public function lectures (){ return $this->has_many('Lecture');  }
	public function materials(){ return $this->has_many('Material'); }
	public function timetable(){ return $this->has_one('Timetable'); }
	public function sheets   (){ return $this->has_many('Sheet');    }
	public function documents(){ return $this->has_many('Document'); }

	/*
	| Indirect Relationships of type 2 layers
	*/
	// public function sheets()
	// {
	// 	return Algorithms::two_loops_push(Auth::user()->group->materials, 'sheets'   );
	// }
	// public function documents()
	// {
	// 	return Algorithms::two_loops_push(Auth::user()->group->materials, 'documents');
	// }


	public function name()
	{
		return $this->department;
	}

	public function year()
	{
		if($this->year == 1)
			return 'First';
		if($this->year == 2)
			return 'Second';
		if($this->year == 3)
			return 'Third';
		if($this->year == 4)
			return 'Fourth';
	}

}
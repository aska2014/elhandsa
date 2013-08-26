<?php

class Member extends User {

	/*
	| Defining Relationships
	*/
	public function instructor(){ return $this->belongs_to('Instructor'); }//=> Not each member belongs to instructor only of type != 0
	
	public function isdoctor(){
		if($this->type == 2)
			return true;
		return false;
	}
	public function isprofessor(){
		if($this->type == 1)
			return true;
		return false;
	}
	public function isinstructor(){
		if($this->isdoctor() || $this->isprofessor())
			return true;
		return false;
	}

	public function who(){
		if($this->isdoctor())
			return 'Doctor';
		else if($this->isprofessor())
			return 'Professor';
		else
			return 'Student';
	}

}
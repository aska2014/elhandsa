<?php

class Instructor extends Eloquent {

	/*
	| Defining Relationships
	*/
	public function materials(){ return $this->has_many('Material'); }
	public function member()   { return $this->has_one('Member');    }

}
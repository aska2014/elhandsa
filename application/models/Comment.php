<?php

class Comment extends Eloquent{

	/*
	| Defining Relationships
	*/
	public function member(){ return $this->belongs_to('Member'); }
	public function post(){ return $this->belongs_to('Post'); }


	/**
	* Override parent save function
	*/
	public function save()
	{
		$this->member_id = Auth::user()->id;
		parent::save();
	}

	/**
	 * @return String :: modified format of the creation date
	 */
	public function date()
	{
		if(gettype($this->created_at) == "string")
			return date('j F, g:i a', strtotime($this->created_at));
		else if(gettype($this->created_at) == "object")
			return $this->created_at->format('j F, g:i a');
	}
	
}
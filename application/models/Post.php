<?php

class Post extends Eloquent{

	/*
	| Defining Relationships
	*/
	public function member  (){ return $this->belongs_to('Member'); }
	public function group   (){ return $this->belongs_to('Group');  }
	public function comments(){ return $this->has_many('Comment');  }

	/**
	* Override save function
	*/
	public function save()
	{
		if(isset($this->member_id) && $this->member_id != Auth::user()->id)
			return false;
		$this->member_id = Auth::user()->id;
		if(!isset($this->type))
			$this->type = Auth::user()->type;
		$this->group_id = Auth::user()->group_id;
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

	public function delete()
	{
		if($this->member_id == Auth::user()->id)
		{
			parent::delete();
		}
	}

	/**
	 * Append member id to post likes 
	 */
	public function iLike()
	{
		if(!$this->iLikeExist())
		{
			$this->likes .= ','.Auth::user()->id;
		}
		parent::save();
	}

	/** 
	 * Checks if user hasn't already liked the post
	 * @return boolean
	 */
	public function iLikeExist()
	{
		if(in_array(Auth::user()->id, explode(",", $this->likes)))
			return true;
		return false;
	}


	/**
	 * Return members who like this post
     * @return Member array
	 */
	public function likes()
	{
		$likes_members = explode(",", $this->likes);
		$array = array();
		foreach ($likes_members as $member_id) {
			$member = Member::find($member_id);
			if(!is_null($member))
				array_push($array, $member);
		}
		return $array;
	}
}
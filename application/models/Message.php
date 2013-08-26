<?php

class Message extends Eloquent{

	/*
	| Special case
	| Message unfortunatly can't have Many-To-Many Relationship with a Member
	*/
	public function member() { return $this->belongs_to('Member'); }

	/**
	 * @override parent save function
	 */
	public function save()
	{
		if(is_null($this->member_id))
		{
			$this->member_id = Auth::user()->id;
			if($this->to_id == Auth::user()->id) // Member has send message to himself
				return false;
		}
		
		parent::save();
	}

	/**
	 * Get the other member
	 * @return Member object
	 */
	public function other_member(){
		if($this->member_id == Auth::user()->id)
			$member = Member::find($this->to_id);
		else
			$member = $this->member;

		if(is_null($member))
		{
			$this->delete();
			return new Member;	
		}
		else
			return $member;
	}

	/**
	 * Return members that had a conversation with current user ordered by message creation date
	 * @return members
	 */
	public static function conversations()
	{
		$messages = Message:: where   ('member_id' , '=', Auth::user()->id)
							->or_where('to_id'     , '=', Auth::user()->id)
							->order_by('created_at', 'desc')
							->take(30)
							->get();

		$new_messages    = array();
		$members_id = array();
		foreach ($messages as $message) {
			$other_member = $message->other_member();
			if(!in_array($other_member->id, $members_id))
			{
				array_push($members_id     , $other_member->id);
				array_push($new_messages   , $message);
			}
		}

		return $new_messages;
	}

	/**
	 * @param $member2_id
	 * @return objects array
	 */
	public static function conversation($member2_id = 0)
	{
		$member1_id = Auth::user()->id;
		if($member2_id)
		{
			return Message::where   (function($query, $data)
								    {
								    	$query->where('member_id' , '=' , $data[0]);
								  	    $query->where('to_id'     , '=' , $data[1]);
								    }
								    , null, null, 'AND', array($member1_id, $member2_id))
						  

						  ->where(function($query, $data)
								  	{
								    	$query->where('to_id'     , '=' , $data[0]);
								  		$query->where('member_id' , '=' , $data[1]);
								    }
								    , null, null, 'OR', array($member1_id, $member2_id))
						  

						  ->get();
		}
		return false;
	}

	public static function conversations_other_members() 
	{
		$members = array();
		$conversations = self::conversations();
		foreach ($conversations as $conversation) {
			array_push($members, $conversation->other_member());
		}
		return $members;
	}

	public static function new_messages()
	{
		return Message::where('to_id', '='  , Auth::user()->id)
					  ->where('seen', '!= ', '1')
					  ->get();
	}

	
	/**
	 * Update the seen of all given messages array
	 * @param Array of Message
	 */
	public static function seenAll($messages)
	{
		foreach ($messages as $message) {
			$message->seen = 1;
			$message->save();
		}
	}


	public function seen()
	{
		if($this->member_id == Auth::user()->id)
			return true;
		return (int)$this->seen;
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
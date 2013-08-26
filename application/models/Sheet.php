<?php

class Sheet extends Eloquent{

	/*
	| Defining Relationships
	*/
	public function member  (){ return $this->belongs_to('Member');   }
	public function material(){ return $this->belongs_to('Material'); }
	public function group   (){ return $this->belongs_to('Group');    }


	/**
	* Override save function
	*/
	public function save()
	{
		$this->member_id = Auth::user()->id;
		$this->group_id  = Auth::user()->group_id;
		parent::save();

		// Insert notification that a sheet has been uploaded
		$notification = new Notification;
		$notification->title    = "Sheet";
		$notification->body     = "<b>".Auth::user()->name()."</b> has uploaded new <b>sheet</b> for ".$this->material->name.'. <a href="'.$this->file_url.'" target="_blank">Click here</a> to download ';
		$notification->type     = "sheet";
		$notification->save();
		setcookie('sheet_not', $this->id, time() + Date::DaystoSeconds(5),'/');
	}

	/**
	 * Checks if delivered date reached or not
	 * @return boolean
	 */
	public function current()
	{
		if(strtotime($this->deliver_at) > strtotime(date('Y-m-d')))
			return true;
		return false;
	}

	/**
	 * Gets students that have finished this sheet
	 * @return Member objects
	 */
	public function finished()
	{
		$members_id = explode(",", $this->finished);
		$members = array();
		foreach ($members_id as $member_id) {
			$member = Member::find($member_id);
			if(!is_null($member))
				array_push($members, $member);
		}
		return $members;
	}

	/**
	* Upload file in the Input object
	* @param Input object
	*/
	public function upload($input)
	{
		if(isset($input['file']['tmp_name']))
		{
			$file_name = 'sheet'.$this->id.'.'.File::extension($input['file']['name']);
			$this->file_url = URL::to('public/files/sheets/'.$file_name);
			Input::upload('file', path('public').'/files/sheets/', $file_name);
			$this->save();
		}

	}

}
<?php

class Document extends Eloquent{

	/*
	| Defining Relationships
	*/
	public function member(){ return $this->belongs_to('Member'); }
	public function material(){ return $this->belongs_to('Material'); }
	public function group(){ return $this->belongs_to('Group'); }

	/**
	* Override save function
	*/
	public function save()
	{
		$this->member_id = Auth::user()->id;
		$this->group_id  = Auth::user()->group_id;
		parent::save();

		// Insert notification that a document has been uploaded
		$notification           = new Notification;
		$notification->title    = "Document";
		$notification->body     = "<b>".Auth::user()->name()."</b> has uploaded new <b>document</b> for ".$this->material->name.'. <a href="'.$this->file_url.'" target="_blank">Click here</a> to download ';
		$notification->type     = "document";
		$notification->save();
		setcookie('document_not', $this->id, time() + Date::DaystoSeconds(5),'/');
	}

	/**
	* Upload file in the Input object
	* @param Input object
	*/
	public function upload($input)
	{
		if(isset($input['file']['tmp_name']))
		{
			$file_name = 'document'.$this->id.'.'.File::extension($input['file']['name']);
			$this->file_url = URL::to('public/files/documents/'.$file_name);
			Input::upload('file', path('public').'/files/documents/', $file_name);
			$this->save();
		}
	}

}
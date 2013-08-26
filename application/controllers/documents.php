<?php

class Documents_Controller extends Base_Controller{

	public $restful = true;

	public function get_index()
	{
		$materials =  Auth::user()->group->materials;

		Notifications::doSee('document');
		return MyView::make('documents.master')->with('materials', $materials);
	}

}
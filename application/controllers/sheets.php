<?php


class Sheets_Controller extends Base_Controller{

	public $restful = true;

	function get_index()
	{
		$sheets = Auth::user()->group->sheets()->order_by('deliver_at','desc')->get();

		Notifications::doSee('sheet');
		return MyView::make('sheets.master')->with('sheets', $sheets);
	}

}
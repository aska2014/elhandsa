<?php

class Base_Controller extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */

	function __construct()
	{
		// Set updated at column to current Time to be used in online algorithm
		if(!Auth::guest())
		{
			Auth::user()->updated_at = new DateTime;
			Auth::user()->save();
		}
		$this->filter('before','auth');
	}

	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

}
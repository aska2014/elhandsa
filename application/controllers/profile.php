<?php


class Profile_Controller extends Base_Controller{
	
	public $restful = true;

	public function get_index($name = "", $id = 0)
	{
		if($id == 0)
			$member = Auth::user();
		else
			$member = Member::find($id);
		$change_status = (isset($_GET['change_status']))? $_GET['change_status']:false;

		return MyView::make('profile.master')->with('member'       , $member)
											 ->with('change_status', $change_status);
	}

	public function get_edit($success = "")
	{
		return MyView::make('profile.master')->with('display', 'edit')
											 ->with('success', $success);
	}

	public function post_send_message()
	{
		$input = Input::all();

		$message = new Message;
		$message->body = $input['body'];
		$message->save();

		if(Request::ajax())
		{
			echo 'sucess';
			exit();
		}
		else
			return $this->get_index();
	}

	public function post_update_status()
	{
		$input = Input::all();

		$member = Auth::user();
		$member->status = $input['status'];

		$member->save();
		return Redirect::to('profile');
	}

	public function post_upload_img()
	{
		Auth::user()->upload(Input::all());

		return Redirect::to('profile/edit/img_success');
	}

	public function post_edit()
	{
		$input = Input::all();

		Auth::user()->cell_phone = $input['cell_phone'];
		Auth::user()->home_town  = $input['home_town'];
		if($input['birthday_day'] && $input['birthday_month'])
			Auth::user()->birthday = '1991-'.$input['birthday_month'].'-'.$input['birthday_day'];
		Auth::user()->hoppies    = $input['hoppies']; 
		Auth::user()->about      = $input['about'];

		Auth::user()->save();

		return Redirect::to('profile/edit/basic_success');
	}

	public function post_change_password()
	{
		$input = Input::all();

		if(Hash::check($input['old_password'], Auth::user()->password))
		{
			if(strlen($input['new_password']) > 6 && $input['new_password'] == $input['retype_new_password'])
			{
				Auth::user()->password = Hash::make($input['new_password']);
				Auth::user()->save();

				echo 'success';
			}
			else
			{
				echo 'Password must be more than 6 characters and match';
			}
		}
		else
		{
			echo 'Old Password is incorrect';
		}
		exit();
	}

}
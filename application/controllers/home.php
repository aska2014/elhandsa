<?php

class Home_Controller extends Base_Controller {

	public $restful = true;
	public function get_index      (){ return $this->main_view('0'); }
	public function get_students   (){ return $this->main_view('0'); }
	public function get_instructors(){ Notifications::doSeeInstructors(); return $this->main_view('1'); }

	public function main_view($posts_type)
	{
		$view = MyView::make('home.master');

		if(Auth::user()->isinstructor())
			$posts_type = 1;

		$view->materials  = Auth::user()->group->materials;
		$view->posts      = Auth::user()->group->posts()->where_type($posts_type)->order_by('id', 'desc')->take(10)->get();
		$view->posts_type = $posts_type;

		if(Auth::user()->isinstructor())
			$view->add_post_textarea = 'Write something to share with the group...';
		else if($posts_type == 0)
			$view->add_post_textarea = 'Write something to share with group students only...';
		else
			$view->add_post_textarea = 'Write something to share with the group...';

		$view->footer = true;
		$view->notifications = Notifications::home_notifications();
		$view->online_members = Member::online();

		return $view;
	}

	/*
	|--------------------------------------------------------------------------------------
	| Handle Post requests
	|----------------------
	| 	1. Adding post
	|	2. Addding comment
	| 	3. Deleteing comment
	|	4. Adding new sheet
	|	5. Update Lecture status
	|	6. Add new document
	|
	*/

	public function post_add_post()
	{
		$input = Input::all();

		$post = new Post;
		$post->body = $input['body'];
		$post->type = $input['type'];
		$post->save();

		echo echoHTML::echo_post($post);

		exit();
	}

	/*
	| Add new Comment
	|---------------
	| We need encoded post_id
	*/
	public function post_add_comment()
	{
		$input = Input::all();

		$post = Post::find(Hash::decode($input['post_id']));
		if($post)
		{
			$comment = new Comment;
			$comment->body = $input['body'];
			$comment->post_id = $post->id;
			$comment->save();
					
			echo echoHTML::echo_comment($comment);
		}
		exit();
	}

	/*
	| Delete Comment
	|---------------
	| We need encoded post_id
	*/
	public function post_delete_comment()
	{
		$post = Post::find(Hash::decode($_POST['post_id']));
		if($post)
		{
			echo 'success'.$post->id;
			$post->delete();
		}
		exit();
	}

	/*
	| Add new Sheet
	|---------------
	| We need material_id, deliver_at date.
	*/
	public function post_add_sheet()
	{
		$input = Input::all();
		$rules = array(
			'material_id' => 'required|exists:materials,id',
			'deliver_at' => 'required');
		$validation = Validator::make($input, $rules);
		$errors = '';

		if($validation->fails())
		{
			$errors = implode('<br />', $validation->errors->all());
			echo $errors;
		}
		else
		{
			$material = Material::find($input['material_id']);

			if($material && $material->group_id == Auth::user()->group_id)
			{
				$sheet = new Sheet;
				$sheet->name = $input['name'];
				$sheet->material_id = $input['material_id'];
				$sheet->deliver_at = date('Y-m-d', strtotime($input['deliver_at']));
				
				if($sheet->deliver_at < date('Y-m-d'))
				{
					echo 'The date you have choosed is in the past';
					exit();	
				}
				if(strlen($input['url']) < 10 && !is_array($input['file']))
				{
					echo 'You have to enter the URL or choose the file';
					exit();
				}
				
				if($input['file']['size'] > (1024 * 1024))
				{
					echo 'The file size is more than 1M. <a href="'.URL::to('upload').'" style="color:#66F" target="_blank">Click here to upload on mediafire</a>';
					exit();
				}


				if(strlen($input['url']) >= 10)
				{
					$sheet->file_url = $input['url'];
					$sheet->save();
					echo 'success';
					exit();
				}
				
				$sheet->save();
				$sheet->upload($input);
				echo 'success';
				exit();
			}
			else
			{
				$errors = 'You have to choose the material';
				echo $errors;
			}
		}
		if (Request::ajax())
			exit();
		else
			return Redirect::back()->with_errors($errors);
	}

	/*
	| Updating lecture states
	|-------------------------
	| We need material_id, type, state,
	| if(state == "canceled") delayed_date, start_at, end_at
	|
	| Steps: 
	| 1. Validate
	| 2. Get day of entered date ex: 'Sunday'
	| 3. Check if there's a lecture of the entered type at this day
	| 4. Check if a lecture exists at the same time as this lecture
	| 5. Save lecture
	*/
	public function post_update_lecture()
	{
		$input = Input::all();

		$rules = array(
			'material_id' => 'required|exists:materials,id',
			'state' => 'in:canceled,delayed',
			'type' => 'in:lecture,section',
			'canceled_date' => 'required');
		if($input['state'] == "delayed")
		{
			$rules = array_merge($rules, array(
				'delayed_date' => 'required',
				'delayed_start_at' => 'required',
				'delayed_end_at' => 'required'
				));
		}

		$validation = Validator::make($input, $rules);
		$errors = '';

		if($validation->fails())
		{
			$errors = implode('<br />', $validation->errors->all());
			echo $errors;
		}
		else
		{
			$material = Material::find($input['material_id']);
			$day = date('l', strtotime($input['canceled_date']));
			$lecture  = Lecture::where_day_and_type_and_material_id($day, $input['type'],$material->id)->first();
			if($lecture)
			{
				$lecture->state = $input['state'];
				if($lecture->state == "delayed")
				{
					$lecture->delayed_date     = date('Y-m-d', strtotime($input['delayed_date']));
					$lecture->delayed_start_at = str_replace(":", ".", $input['delayed_start_at']);
					$lecture->delayed_end_at   = str_replace(":", ".", $input['delayed_end_at']);

					$delayed_exists = $lecture->delayed_exists();
					if($delayed_exists && !isset($input['overwrite']))
					{
						echo $delayed_exists->name().' is at the same time as this '.$input['type'].' ! <br />You can choose to overwrite this '.$delayed_exists->material->name.' '.$input['type'].' by checking the overwrite box.';
					}
					else
					{
						echo 'success';
						$lecture->save();
					}
				}
				else
				{
					echo 'success';
					$lecture->canceled_date = date('Y-m-d', strtotime($input['canceled_date']));
					$lecture->save();	
				}
			}
			else
			{
				$errors = 'There\'s no '.$input['type'].' for '.$material->name. ' at this day';
				echo $errors;
			}
		}
		if (Request::ajax())
			exit();
		else
			return Redirect::back()->with_errors($errors);
		exit();
	}

	/*
	| Adding document
	| -------------------
	| We need material id only
	*/
	public function post_add_document()
	{
		$input = Input::all();
		$rules = array(
			'material_id' => 'required|exists:materials,id',
			'name'        => 'required',
			'url'         => 'required');
		$validation = Validator::make($input, $rules);
		$errors = '';

		if($validation->fails())
		{
			$errors = implode('<br />', $validation->errors->all());
			echo $errors;
		}
		else
		{
			$material = Material::find($input['material_id']);

			if($material && $material->group_id == Auth::user()->group_id)
			{
				$document = new Document;
				$document->material_id = $input['material_id'];
				$document->name        = $input['name'];
				$document->file_url    = $input['url'];
				$document->save();
				echo 'success';
			}
			else
			{
				$errors = 'You have to choose the material';
				echo $errors;
			}
		}
		if (Request::ajax())
			exit();
		else
			return Redirect::back()->with_errors($errors);
	}

	public function post_checkPost($last_post, $posts_type) {
		if($last_post != strval(intval($last_post)))
			exit();
		$posts    = Post::where('id'      , '>'  , $last_post             )
					   ->where('group_id' , '='  , Auth::user()->group_id )
					   ->where('type'     ,'='   , $posts_type            )
					   ->where('member_id', '!=' , Auth::user()->id       )
					   ->order_by('id'    , 'desc')
					   ->get();

		foreach ($posts as $post) {
			echo echoHTML::echo_post($post);
		}

		exit();

	}

	public function post_likePost() {
		$input = Input::all();
		$post = Post::find(Hash::decode($input['post_id']));

		$post->iLike();

		echo 'success'.$post->id;
		exit();
	}

	public function post_make_online() {
		Auth::user()->updated_at = new DateTime;
		Auth::user()->save();

		echo echoHtml::echo_online_members(Member::online());
		exit();
	}

	public function post_see_notification($type = "")
	{
		echo $type;
		Notifications::doSee($type);
		exit();
	}


	//--------------------------------------------------------------------------------------\\

}
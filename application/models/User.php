<?php

class User extends Eloquent{

	/*
	| Defining Relationships
	*/
	public function posts    (){ return $this->has_many('Post');        }
	public function comments (){ return $this->has_many('Comment');     }
	public function sheets   (){ return $this->has_many('Sheet');       }
	public function documents(){ return $this->has_many('Document');    }
	public function group    (){ return $this->belongs_to('Group');     }
	public function messages (){ return $this->has_many('Message');     }
	

	/**
	 * Get online members
	 * @static function
	 * @return Member array
	 */
	public static function online() 
	{
		$members = array();
		foreach (Auth::user()->group->members as $member) 
		{
			if($member->id == Auth::user()->id)continue;
			$a = new DateTime($member->updated_at);
			$b = new DateTime;

			$result = $b->diff($a);

			if($result->y == 0 && $result->m == 0 && $result->d == 0 &&
			   $result->h == 0 && $result->i == 0 && $result->s < 20)
			{
				array_push($members, $member);
			}
		}
		return $members;
	}

	/**
	 * @return string :: Full name
	 */
	public function name(){return ucfirst($this->first_name).' '.ucfirst($this->last_name);}

	/**
	 * @param string $th = ("_th" if thumbnail) || ""
	 * @return string
	 */
	public function img($th = "")
	{
		if(file_exists(path('public').'albums'.DS.'members' . $th . DS . 'member' . $this->id . '.jpg'))
			return URL::to('public/albums/members' . $th . '/member' . $this->id . '.jpg');
		else
			return URL::to('public/albums/members' . $th . '/default.jpg');
	}

	/**
	 * @return string :: Profile URL
	 */
	public function profile()
	{
		return URL::to('profile/' . $this->name_url());
	}

	public function name_url()
	{
		return str_replace(" ", "-", $this->first_name).'-'.$this->id;
	}

	/**
	 * @return string 'August 24'
	 */
	public function birthday()
	{
		$check = explode("-", $this->birthday);
		if($check[0] > 1900)
			return date('d F', strtotime($this->birthday));
		return false;
	}


	/**
	 * Check if file size is less than 1MB and upload it as a jpg file
	 *
	 * @param array $file
	 * @return boolean
	 */
	public function upload($input)
	{
		$file = $input['file'];
		$ext = explode(".", $file['name']);
		$ext = $ext[ count($ext) - 1 ];
		$img_array = array('jpeg', 'jpg', 'png', 'gif');
    	// Validate image and Upload
    	if(isset($file['tmp_name']) && in_array(strtolower($ext), $img_array) && 
    		$file['error'] == "0" && $file['size'] < (1000000))
    	{
			
			//$image = new SimpleImage();
			// $image->load($file['tmp_name']);
			// $image->resize(250,250);
  			// $image->save(path('public').'albums'.DS.'members'.DS.'member'.$this->id.'.jpg');
   			// $image->resize(80,80);
   			// $image->save(path('public').'albums'.DS.'members_th'.DS.'member'.$this->id.'.jpg');
    		$image = new SimpleImage();
    		$image->load($file['tmp_name']);
    		$image->member_resize(250, 250, 'members/member'.$this->id.'.jpg');
    		$image->member_resize(80, 80, 'members_th/member'.$this->id.'.jpg');

    		return true;
    	}
    	return false;
	}

	/**
	 * Merge members ordered by latest conversation members then rest of group
	 */
	public static function get_conversation_members() {
		$conv_members         = Message::conversations_other_members();
		$all_members          = Member::where('group_id', '=' , Auth::user()->group_id)
									  ->where('id'      , '!=', Auth::user()->id)
									  ->get();
		$members = Algorithms::merge_object_arrays_by_id($conv_members, $all_members);
		return $members;
	}
} 
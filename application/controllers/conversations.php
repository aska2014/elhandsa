<?php

class Conversations_Controller extends Base_Controller {

	public $restful = true;
	public function get_index() 
	{
		$members      = Member::get_conversation_members();

		return MyView::make('conversations.master')->with('conversations', Message::conversations())
												   ->with('members'      , $members);
	}

	public function get_conversation($name, $id)
	{
		if($id == Auth::user()->id)
		{
			$messages = Message::conversation($id);
			foreach ($messages as $message) {
				$message->delete();
			}
			return Redirect::to('conversations');
		}
		/**
		 * Get Conversation
		 * And confirm that member has seen all messages
		 */
		$messages = Message::conversation($id);
		Message::seenAll($messages);
		/***********************************************/

		$members      = Member::get_conversation_members();

		return MyView::make('conversations.master')->with('display'      , 'conversation')
												   ->with('to_member'    , Member::find($id))
												   ->with('messages'     , $messages)
												   ->with('members'      , $members);
	}



	public function get_return_new($member_id)
	{
		$messages = Message::where('member_id', '=' , $member_id)
						   ->where('seen'     , '=' , 0)
						   ->get();

		foreach ($messages as $message) {
			echo echoHTML::echo_message($message);
			$message->seen = 1;
			$message->save();
		}
		exit();
	}

	public function post_add_message()
	{
		$input = Input::all();

		$message = new Message;
		$message->to_id   = Hash::decode($input['to_id']);
		$message->body    = $input['body'];

		$message->save();

		echo echoHTML::echo_message($message);
		exit();
	}

	public function get_instructors()
	{
		$instructors  = Member::where('type', '!=', '0')
							  ->where('id'  , '!=', Auth::user()->id)
							  ->get();
		echo echoHTML::echo_conversation_members_list($instructors);

		exit();
	}

	public function get_students()
	{
		$members      = Member::get_conversation_members();
		echo echoHTML::echo_conversation_members_list($members);

		exit();
	}

}
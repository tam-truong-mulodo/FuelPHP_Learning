<?php
class Controller_Login extends Controller_Template
{
	public function action_index()
	{
		$this->template->title = 'ログイン';
		$this->template->content = View::forge('login/index');
	} 
}
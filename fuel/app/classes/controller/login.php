<?php
class Controller_Login extends Controller_Template
{
	public function action_index()
	{
		$this->template->title = 'ログイン';
		$this->template->content = View::forge('login/index');
		//$this->template->footer = Html::anchor('http://www.mulodo.com.vn/', 'Mulodo VietNam');
		$this->template->set_global('footer', Html::anchor('http://www.mulodo.com.vn/', 'Mulodo VietNam Inc.'), false);
	} 
}
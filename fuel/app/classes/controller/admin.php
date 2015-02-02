<?php
class Controller_Admin extends Controller
{
    public function action_index()
    {
    	return Html::anchor(Router::get('admin_name'), '管理ページ'); 
    }
}
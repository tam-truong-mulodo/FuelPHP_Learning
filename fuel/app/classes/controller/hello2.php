<?php
class Controller_Hello2 extends Controller
{
    public function action_index()
    {
		// Viewオブジェクトを返す
        return View::forge('hello');
    }
}
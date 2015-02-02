<?php
class Controller_SampleAfter extends Controller
{
    public function after($response)
    {
		$response .= __METHOD__ . 'が実行されました。<br>';
        return parent::after($response);
		//return __METHOD__ . 'が実行されました。<br>';         
    }
    public function action_index()
    {
		return __METHOD__ . 'が実行されました。<br>'; 
	}
    public function action_test()
    {
		return __METHOD__ . 'が実行されました。<br>'; 
	}
}
<?php
class Controller_RoutingTest extends Controller
{
    public function router($resource, $arguments)
    {
    	//echo $this->param('year') . "<br>";
		//echo $this->param('month') . "<br>";
		//echo $this->param('day') . "<br>";
	    // ルート情報を表示 
	    Debug::dump($this->request->route); 
	    // 名前付きパラメータの一覧を表示 
	    Debug::dump($this->params());
	}
}
<?php
class Controller_Hello1 extends Controller
{
    public function action_category($a='1')
    {
    	echo "tam_test"."<br>";
		// 文字列を返す
            if ($a=='1'){
	        	echo "tam_test2 <br>";
	        	//test();
	        }
	        echo "a=".$a."<br>";
	        if ($a=='&lt;s&gt;abc'){
	        	echo "tam_test3 <br>";
	        	//test();
	        }
	        if ($a=='<s>abc'){
	        	echo "tam_test4 <br>";
	        	//test();
	        }
	        
	        function test()
	        {
	        	echo "test function";
	        }
	    return 'Hello World!';
	        
    }
}
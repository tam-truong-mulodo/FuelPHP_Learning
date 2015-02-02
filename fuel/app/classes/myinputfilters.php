<?php
class MyInputFilters
{
	/**
	* 文字エンコーディングの検証フィルタ *
	* @param string|array $value
	* @return string|array
	* @throws HttpInvalidInputException */
    public static function check_encoding($value)
    {
		// 配列の場合は再帰的に処理 
		if (is_array($value))
		{
            array_map(array('MyInputFilters', 'check_encoding'), $value);
            return $value;
        }
		// 文字エンコーディングを検証
		if (mb_check_encoding($value, Fuel::$encoding)) 
		{
    		    return $value;
		}
		else 
		{
			// echo "tam_test: " . __METHOD__. "(line: ".__LINE__.")". "\n";
			// echo 'HttpInvalidInputException character encoding: '. "\n";
			// echo Input::uri(). "\n";
			// echo 'rawurlencode($value)=' . rawurlencode($value) . "\n";
			// echo "Input::ip()=" . Input::ip() . "\n";
			// echo "Input::user_agent()=" . Input::user_agent() . "\n";
			
    		// エラーの場合はログに記録 
			// Log::error(
		 //    	'HttpInvalidInputException character encoding: ' . Input::uri() . ' ' .
		 //    	rawurlencode($value) . ' ' .
		 //    	Input::ip() . ' "' . Input::user_agent() . '"'
			// );
			$msg = 'HttpInvalidInputException character encoding: ';
			static::log_error($msg, $value);
				// エラーを表示して終了
			throw new HttpInvalidInputException('Invalid input data');
		}
	}


	/**
	* 改行コードとタブを除く制御文字が含まれないかの検証フィルタ
	*
	* @param string|array $value
	* @return string|array
	* @throws HttpInvalidInputException
	*/
	public static function check_control($value)
	{
		// 配列の場合は再帰的に処理
		if (is_array($value))
		{
	        array_map(array('MyInputFilters', 'check_control'), $value);
	 		return $value;
	 	}

		// 改行コードとタブを除く制御文字が含まれないか
		if (preg_match('/\A[\r\n\t[:^cntrl:]]*\z/u', $value) === 1)
		{
			return $value;
		}
		else
		{
			// 含まれている場合はログに記録 
			// Log::error(
			// 	'Invalid control characters: ' . Input::uri() . ' ' .
			// 	rawurlencode($value) . ' ' .
			// 	Input::ip() . ' "' . Input::user_agent() . '"'
			// );
			$msg = 'Invalid control characters: ';
			static::log_error($msg, $value);
	
			// エラーを表示して終了
			throw new HttpInvalidInputException('Invalid input data');
		}
	}

	// エラーをログに記録
	public static function log_error($msg, $value)
	{
	    Log::error(
	        $msg . ': ' . Input::uri() . ' ' . rawurlencode($value) . ' ' .
	        Input::ip() . ' "' . Input::user_agent() . '"');
	}
}
<?php
class Controller_Form extends Controller_Template
{

	public function action_index()
	{
		//$this->tam_test();//test
		$this->template->title = '問い合わせ';
		$this->template->content = View::forge('form/index');
		//$this->template->set_global('footer', Html::anchor('http://www.mulodo.com.vn/', 'Mulodo VietNam Inc.'), false);
	} 

	public function action_confirm() 
	{
		echo 'test1';
	   	//$val = $this->forge_validate();
		$val = $this->forge_validate()->add_callable('MyValidationRules');
		echo 'test2';
		if ($val->run())
		{
		    $data['input'] = $val->validated();
                    var_dump($data);
			$this->template->title = 'お問い合わせ: 確認';
			$this->template->content = View::forge('form/confirm', $data);
		}
		else
		{
			$this->template->title = 'お問い合わせ: エラー';
		 	$this->template->content = View::forge('form/index');
		 	$this->template->content->set_safe('html_error', $val->show_errors());
		}
	}

	public function action_send() 
	{
		// CSRF対策
		if ( ! Security::check_token())
		{
			throw new HttpInvalidInputException('ページ遷移が正しくありません'); 
		}

		//$val = $this->forge_validate();
		$val = $this->forge_validate()->add_callable('MyValidationRules');

		if ( ! $val->run())
		{
			$this->template->title = 'お問い合わせ: エラー';
		    $this->template->content = View::forge('form/index');
		    $this->template->content->set_safe('html_error', $val->show_errors());
		
			return;
		}

		$post = $val->validated();
		$data = $this->build_mail($post);
		// メールの送信
		try 
		{
			$this->sendmail($data);
			$this->template->title = 'お問い合わせ: 送信完了';
		    $this->template->content = View::forge('form/send');
		
			return;
		}
		catch (EmailValidationFailedException $e)
		{
			Log::error('メール検証エラー: ' . $e->getMessage(), __METHOD__);
		 	$html_error = '<p>メールアドレスに誤りがあります。</p>';
		}
		catch (EmailSendingFailedException $e)
		{
			Log::error('メール送信エラー: ' . $e->getMessage(), __METHOD__);
			$html_error = '<p>メールを送信できませんでした。</p>';
		}

		$this->template->title = 'お問い合わせ: 送信エラー';
		$this->template->content = View::forge('form/index');
		$this->template->content->set_safe('html_error', $html_error);
	}

	// データ検証	
	public function forge_validate()
	{
echo "tam_test: " . __METHOD__. "(line: ".__LINE__.")". "<br>\n";
		$val = Validation::forge();

		$val->add('name', '名前')
			->add_rule('trim')
		 	->add_rule('required')
		 	->add_rule('no_tab_and_newline')
		 	->add_rule('max_length', 50);
echo "tam_test: " . __METHOD__. "(line: ".__LINE__.")". "<br>\n";

		$val->add('email', 'メールアドレス')
            ->add_rule('trim')
            ->add_rule('required')
        	->add_rule('no_tab_and_newline')
		 	->add_rule('max_length', 100)
            ->add_rule('valid_email');

		$val->add('comment', 'コメント')
            ->add_rule('required')
            ->add_rule('max_length', 400);

        return $val;
	}

	// メールの作成
	public function build_mail($post)
	{
		//メール情報
		$data['from']      	= $post['email'];
		$data['from_name'] 	= $post['name'];
		$data['to']			= 'truong.tam@mulodo.com';
		$data['to_name']	= 'test for contact form in fuelphp';
		$data['subject']	= 'お問い合わせフォーム';
	
		$ip    = Input::ip();			//userのIPアドレス
		$agent = Input::user_agent();	//userのブラウンらブラウザ情報
	
		//メール内容
		// $data['body'] = <<< END
		// ------------------------------------------------------------
		// 名前: {$post['name']}
		// メールアドレス: {$post['email']}
		// IPアドレス: $ip
		// ブラウザ: $agent
		// ------------------------------------------------------------
		// コメント:
		// {$post['comment']}
		// ------------------------------------------------------------
		// END;
		$string =	"------------------------------------------------------------
					名前: {$post['name']}
					メールアドレス: {$post['email']}
					IPアドレス: $ip
					ブラウザ: $agent
					------------------------------------------------------------
					コメント:
					{$post['comment']}
					------------------------------------------------------------";
		$data['body'] = $string;	//後で表示の見た目を直す
		
		return $data;
	}

	// メールの送信
	public function sendmail($data)
	{
    	Package::load('email');

	    $email = Email::forge();
	    $email->from($data['from'], $data['from_name']);
	    $email->to($data['to'], $data['to_name']);
	    $email->subject($data['subject']);
	    $email->body($data['body']);

		$email->send();
	}

	//test function
	public function tam_test() 
	{
		$input = mb_convert_encoding('SJISの文字列です。', 'SJIS');
        $test = MyInputFilters::check_encoding($input);
    }

}	


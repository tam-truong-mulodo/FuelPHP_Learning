<?php
/**
 * Description of Model_Mail
 *
 * 
 */
class Model_Mail extends Model
{
    /**
    * メールを作成し送信する
    *
    * @param array $post
    * @return void
    * @throws \EmailValidationFailedException 
    * @throws \EmailSendingFailedException
    * @throws \FuelException
    */
    public function send($post)
    {
        $data = $this->build_mail($post);
        $this->sendmail($data);
    }
    
    // メールの作成
    protected function build_mail($post)
    {
        //問い合わせの設定ファイルから情報を習得
        Config::load('contact_form', true);
        
        //メール情報
        $data['from']       = $post['email'];
        $data['from_name']  = $post['name'];
        //$data['to']         = 'truong.tam@mulodo.com';
        //$data['to_name']    = 'test for contact form in fuelphp';
        //$data['subject']    = '問い合わせフォーム';
        $data['to']         = Config::get('contact_form.admin_email');
        $data['to_name']    = Config::get('contact_form.admin_name');
        $data['subject']    = Config::get('contact_form.subject');

        $ip     = Input::ip();   //userのIPアドレス
        $agent  = Input::user_agent(); //userのブラウンらブラウザ情報
        //メール内容
         $data['body'] = <<< END
------------------------------------------------------------
            名前: {$post['name']}
    メールアドレス: {$post['email']}
       IPアドレス: $ip
         ブラウザ: $agent
------------------------------------------------------------
コメント:
{$post['comment']}
------------------------------------------------------------
END;

        return $data;
    }

    // メールの送信
    protected function sendmail($data)
    {
        Package::load('email');

        $email = Email::forge();
        $email->from($data['from'], $data['from_name']);
        $email->to($data['to'], $data['to_name']);
        $email->subject($data['subject']);
        $email->body($data['body']);

        $email->send();
    }
}

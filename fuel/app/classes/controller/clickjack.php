<?php

/*
 * クリックジャック
 * 
 * クリックジャック対策のための X-FRAME-OPTIONS ヘッダの値は
 * DENY または SAMEORIGIN が 指定できますが、ここでは SAMEORIGIN にしておきます。
 * DENY はそのページがフレーム内に表示 されることをすべて禁止します。
 * SAMEORIGIN は同一ドメインのページのみでフレーム内に表示され ることを許可します。
 */

class Controller_Clickjack extends Controller_Template
{

    public function before()
    {
        parent::before();
        $this->response = Response::forge();
        $this->response->set_header('X-FRAME-OPTIONS', 'SAMEORIGIN');
    }

    public function after($response)
    {
        $response = $this->response;
        $response->body = $this->template;
        return parent::after($response);
    }

}

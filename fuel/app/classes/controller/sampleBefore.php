<?php
class Controller_SampleBefore extends Controller
{
    public function before()
    {
		// 例えば、認証済みでなかったらログインページへ飛ばす 
		// 認証済みなら、ユーザ名をプロパティにセットする
		$this->current_user = 'Tam';
    }
    public function action_index()
    {
        // 実行時間の計測ポイント 
        Profiler::mark('indexアクションの開始 ');

		$output = $this->current_user . 'さん、' . __METHOD__ . 'が実行されました。<br>';

        // 実行時間の計測ポイント 
        Profiler::mark('indexアクションの終了 ');

        return $output;
    }
    public function action_test()
    {
		$output = $this->current_user . 'さん、' . __METHOD__ . 'が実行されました。<br>';
        return $output;
    }
}
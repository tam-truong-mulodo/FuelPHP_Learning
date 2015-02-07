<?php

/*
 * 機能毎にテストするクラス
 *  
 */

use Goutte\Client;

class FunctionalTestCase extends \Fuel\Core\TestCase
{

    const BASE_URL = 'http://localhost/fuelphp/';

    protected static $client;   // Clientオブジェクト 
    protected static $crawler;  // Crawlerオブジェクト 
    protected static $post;     // POSTデータ

    /*
     * テスト環境に変更
     * 
     * PHPUnitの最初のテストケースを実行する前にsetUpBeforeClass()を呼ばれる
     */
    public static function setUpBeforeClass()
    {    
        // .htaccessをテスト環境用に変更
        $htaccess = DOCROOT . 'public/.htaccess';
        $htaccess_develop = DOCROOT . 'public/.htaccess_develop';
        $htaccess_test = DOCROOT . 'public/.htaccess_test';
        
        //.htaccessをbackupする
        if (!file_exists($htaccess_develop) || filemtime($htaccess) > filemtime($htaccess_develop)) {
            $ret = rename($htaccess, $htaccess_develop);
            if ($ret === false) {
                exit('Error: can\'t backup ".htaccess" !'."\n");
            }
        }
        if (!file_exists($htaccess_test)) {
            exit('Error: ".htaccess_test" does not exist!'."\n");
        }
        //テスト環境に設定
        $ret = copy($htaccess_test, $htaccess);
        if ($ret === false) {
            exit('Error: can\'t copy ".htaccess_test" !'."\n");
        }
        // GoutteのClientオブジェクトを生成
        static::$client = new Client();
    }

     /*
     * 開発環境に戻る
     * 
     * PHPUnitの最後のテストケースを実行した後にtearDownAfterClass()を呼ばれる
     */
    public static function tearDownAfterClass()
    {
        static::$client = null;
        static::$crawler = null;
        static::$post = null;

        // .htaccessを開発環境用に戻す
        $htaccess = DOCROOT . 'public/.htaccess';
        copy($htaccess . '_develop', $htaccess);
        touch($htaccess, filemtime($htaccess . '_develop'));
    }

    // 絶対URLを返す
    public static function open($uri)
    {
        return static::BASE_URL . $uri;
    }

}

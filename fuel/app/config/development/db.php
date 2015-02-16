<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
    'default' => array(
        'connection'  => array(
            'hostname' => '127.0.0.1',  // TCP・IP経由でmysqlに接続する為、
            //'hostname' => 'localhost',// 明示にIPアドレスを指定しなければなりません
            'port'     => '3306',
            'database' => 'fuel_dev',
            'username' => 'fuel_dev',
            'password' => 'tammulodo',
        ),
        'profiling' => true,
    ),
);


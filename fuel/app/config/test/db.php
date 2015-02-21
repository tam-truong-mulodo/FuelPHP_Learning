<?php
/**
 * The test database settings. These get merged with the global settings.
 *
 * This environment is primarily used by unit tests, to run on a controlled environment.
 */

return array(
    'default' => array(
        'connection'  => array(
            'hostname' => '127.0.0.1',  // TCP・IP経由でmysqlに接続する為、
            //'hostname' => 'localhost',// 明示にIPアドレスを指定しなければなりません
            'port'     => '3306',
            'database' => 'fuel_test',
            'username' => 'fuel_test',
            'password' => 'tammulodo',
        ),
        'profiling' => true,
    ),
);

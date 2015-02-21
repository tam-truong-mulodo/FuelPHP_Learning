<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2014 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(
	'driver' => 'Simpleauth',
	'verify_multiple_logins' => false,
    //パスワードのソルトの設定
	//'salt' => 'mysalt',
	'salt' => '2165d8b4afb5b5124b91392d3ca6adac', //kokoro
	'iterations' => 10000,
);

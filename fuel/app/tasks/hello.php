￼<?php

namespace Fuel\Tasks;

class Hello {
    public static function run($name = 'World')
    {
        echo 'Hello ' . $name . '!', PHP_EOL;
    }
}
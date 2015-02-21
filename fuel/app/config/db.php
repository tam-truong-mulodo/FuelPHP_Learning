<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
    'default' => array(
        'type' => 'mysqli',
        'connection'  => array(
            'persistent' => false,
        ),
        'identifier'    => '`',
        'table_prefix'  => '',
        'charset'       => 'utf8',
        //'collation'     => 'false',
        'collation'     => 'utf8_general_ci',
        'enable_cache'  => true,
        'profiling'     => false,
        'readonly'      => false,
    ),
);

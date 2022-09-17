<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Validator\RemoteAddr;
use Zend\Session\Validator\HttpUserAgent;
use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;
 
 
return [
        // Session configuration.
        'session_config' => [
                //'cookie_lifetime'     => 60*60*1, // Session cookie will expire in 1 hour.
                'cookie_lifetime'     => 60*60*8, // Session cookie will expire in 8 hour.
                'gc_maxlifetime'      => 60*60*24*30, // How long to store session data on server (for 1 month).
        ],
        // Session manager configuration.
        'session_manager' => [
                // Session validators (used for security).
                'validators' => [
                        RemoteAddr::class,
                        HttpUserAgent::class,
                ]
        ],
        // Session storage configuration.
        'session_storage' => [
                'type' => SessionArrayStorage::class
        ],
        'view_helper_config' => array(
            'flashmessenger' => array(
                'message_open_format'      => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
                'message_close_string'     => '</li></ul></div>',
                'message_separator_string' => '</li><li>'
            )
        ),

];

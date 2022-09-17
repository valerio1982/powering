<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Rest;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'test' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/test[/:id]',
                    'defaults' => [
                        'controller' => Controller\RestController::class,
                    ],
                ],
            ],
            'get_automezzi' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/getAutomezzi',
                    'defaults' => [
                        'controller' => Controller\RestController::class,
                        'action'     => 'customAutomezziRest',
                    ],
                ],
            ],
            'get_filiali' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/getFiliali',
                    'defaults' => [
                        'controller' => Controller\RestController::class,
                        'action'     => 'customFilialiRest',
                    ],
                ],
            ],
            //end of routes
        ],
    ],
    'controllers' => [
        'factories' => [
        		Controller\RestController::class => Factory\RestControllerFactory::class,
        ],
    ],
	'doctrine' => [
			'driver' => array (
					'ApplicationYamlDriver' => array (
							'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',
							'cache' => 'array',
							'extension' => '.dcm.yml',
							'paths' => array (
									__DIR__ . '/yml'
							)
					),
					'orm_default' => array (
							'drivers' => array (
									'Application\Entity' => 'ApplicationYamlDriver'
							)
					)
			),
	],

    /*'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],*/
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];

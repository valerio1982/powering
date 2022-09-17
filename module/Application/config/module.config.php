<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'elenco_filiali' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/elencofiliali',
                    'defaults' => [
                        'controller' => Controller\FilialiController::class,
                        'action'     => 'elencoFiliali',
                    ],
                ],
            ],
            'crea_filiale' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/creafiliale[/]',
                    'defaults' => [
                        'controller' => Controller\FilialiController::class,
                        'action'     => 'creaFiliale',
                    ],
                ],
            ],
            'modifica_filiale' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/modificafiliale[/:codice][/]',
                    'defaults' => [
                        'controller' => Controller\FilialiController::class,
                        'action'     => 'modificaFiliale',
                    ],
                ],
            ],
            'cancella_filiale' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/cancellafiliale[/:codice][/]',
                    'defaults' => [
                        'controller' => Controller\FilialiController::class,
                        'action'     => 'cancellaFiliale',
                    ],
                ],
            ],
            'dettaglio_filiale' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/dettagliofiliale[/:codice][/]',
                    'defaults' => [
                        'controller' => Controller\FilialiController::class,
                        'action'     => 'dettaglioFiliale',
                    ],
                ],
            ],
            'elenco_automezzi' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/elencoautomezzi',
                    'defaults' => [
                        'controller' => Controller\AutomezziController::class,
                        'action'     => 'elencoAutomezzi',
                    ],
                ],
            ],
            'crea_automezzo' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/creaautomezzo[/]',
                    'defaults' => [
                        'controller' => Controller\AutomezziController::class,
                        'action'     => 'creaAutomezzo',
                    ],
                ],
            ],
            'modifica_automezzo' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/modificaautomezzo[/:codice][/]',
                    'defaults' => [
                        'controller' => Controller\AutomezziController::class,
                        'action'     => 'modificaAutomezzo',
                    ],
                ],
            ],
            'cancella_automezzo' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/cancellaautomezzo[/:codice][/]',
                    'defaults' => [
                        'controller' => Controller\AutomezziController::class,
                        'action'     => 'cancellaAutomezzo',
                    ],
                ],
            ],
            'chiamata_http' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/postdata',
                    'defaults' => [
                        'controller' => Controller\PostController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'invia_dati' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/inviadati[/:tipo][/]',
                    'defaults' => [
                        'controller' => Controller\PostController::class,
                        'action'     => 'invia',
                    ],
                ],
            ],

            //end of routes
        ],
    ],
    'controllers' => [
        'factories' => [
        		Controller\IndexController::class => Factory\IndexControllerFactory::class,
                Controller\PostController::class => Factory\PostControllerFactory::class,
                Controller\AutomezziController::class => Factory\AutomezziControllerFactory::class,
                Controller\FilialiController::class => Factory\FilialiControllerFactory::class,
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
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

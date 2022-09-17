<?php
namespace Rest\Factory;

use Rest\Controller\RestController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * This is the factory for RestController. Its purpose is to instantiate the
 * controller.
 */
class RestControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		$entityManager = $container->get('doctrine.entitymanager.orm_default');
        $config = $container->get("Config");
		// Instantiate the controller and inject dependencies
		return new RestController($entityManager,$config);
	}
}
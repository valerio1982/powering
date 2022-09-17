<?php
namespace Application\Factory;

use Application\Controller\AutomezziController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller.
 */
class AutomezziControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		$entityManager = $container->get('doctrine.entitymanager.orm_default');
         $config = $container->get("Config");
		// Instantiate the controller and inject dependencies
		return new AutomezziController($entityManager,$config);
	}
}
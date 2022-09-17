<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;


/**
 * @author Ing. Giacinto Girelli
 * Class IndexController
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * configuration file
     * @var unknown
     */
    private $config;


    // Constructor method is used to inject dependencies to the controller.
    public function __construct($entityManager,$config)
    {
        $this->entityManager = $entityManager;
        $this->config = $config;
    }

    public function indexAction()
    {
        return new ViewModel([]);
    }

}
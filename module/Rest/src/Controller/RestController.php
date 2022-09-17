<?php


namespace Rest\Controller;


use Application\Entity\Automezzo;
use Application\Entity\Filiale;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

/**
 * @author Ing. Giacinto Girelli
 * Class RestController
 * @package Rest\Controller
 */
class RestController extends AbstractRestfulController
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



    public function __construct($entityManager,$config)
    {
        $this->entityManager = $entityManager;
        $this->config = $config;
    }

    protected function methodNotAllowed()
    {
        $this->response->setStatusCode(405);
        return new JsonModel(array("message"=>"Method Not Allowed"));
    }

    public function indexAction(){

        return new ViewModel([]);
    }



    public function customAutomezziRestAction(){
        $method = $this->getRequest()->getMethod();

        switch ($method)
        {
            case 'POST':
                return $this->methodNotAllowed();
                break;
            case 'GET':
                return $this->getAutomezziList();
                break;
            case 'PUT':
                return$this->methodNotAllowed();
                break;
            case 'DELETE':
                return $this->methodNotAllowed();
                break;
            default:
                return $this->methodNotAllowed();
        }
    }


    public function customFilialiRestAction(){
        $method = $this->getRequest()->getMethod();

        switch ($method)
        {
            case 'POST':
                return $this->methodNotAllowed();
                break;
            case 'GET':
                return $this->getFilialiList();
                break;
            case 'PUT':
                return$this->methodNotAllowed();
                break;
            case 'DELETE':
                return $this->methodNotAllowed();
                break;
            default:
                return $this->methodNotAllowed();
        }
    }

    public function getAutomezziList()
    {
        $automezziArray = $this->entityManager->getRepository(Automezzo::class)->trovaAutomezziArray();
        return new JsonModel(array("email"=>"mia_email@esempio.it","data" =>$automezziArray));
    }

    public function getFilialiList()
    {
        $filialiArray = $this->entityManager->getRepository(Filiale::class)->trovaFilialiArray();
        return new JsonModel(array("email"=>"mia_email@esempio.it","data" =>$filialiArray));
    }

}
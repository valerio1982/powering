<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;



use Application\Entity\Automezzo;
use Application\Entity\Filiale;
use Application\Form\AutomezzoForm;
use Application\InputFilter\AutomezzoFormFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

/**
 * @author Ing. Giacinto Girelli
 * Class AutomezziController
 * @package Application\Controller
 */
class AutomezziController extends AbstractActionController
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


    public function elencoAutomezziAction(){
        $automezziArray = $this->entityManager->getRepository(Automezzo::class)->trovaAutomezziArray();
        $jsonData = json_encode($automezziArray,JSON_HEX_APOS);

        return new ViewModel([
            'jsonData'=>$jsonData
        ]);
    }

    public function creaAutomezzoAction()
    {
        $form = new AutomezzoForm();
        $filialiArray = $this->entityManager->getRepository(Filiale::class)->trovaFilialiOrdinateArray();
        $form->setFiliali($filialiArray);
        $form->createForm();
        $request = $this->getRequest();
        if ($request->isPost()){
            $inputFilter = new AutomezzoFormFilter();
            $form->setInputFilter($inputFilter->getInputFilter());
            $form->setData($request->getPost());
            if($form->isValid()){
                $data = $form->getData();
                $obj = new Automezzo();
                $obj->setTarga($data['targa']);
                $obj->setMarca($data['marca']);
                $obj->setModello($data['modello']);
                $filialeObj = $filialiArray = $this->entityManager->getRepository(Filiale::class)->find($data['filiale']);
                if(!is_null($filialeObj)){
                    $obj->setFiliale($filialeObj);
                }

                $this->entityManager->persist($obj);

                $this->entityManager->flush();
                return $this->redirect()->toRoute('elenco_automezzi');

            }else{
                //form non valido
            }

        }else{
            //request non è post
        }

        return new ViewModel([
            'form'=>$form
        ]);
    }

    public function modificaAutomezzoAction()
    {
        $codice = (int)$this->params()->fromRoute('codice', -1);
        if ($codice<1) {
            $this->flashMessenger()->addErrorMessage('Errore');
            return $this->redirect()->toRoute('home');
        }

        $obj = $this->entityManager->getRepository(Automezzo::class)->find($codice);

        $form = new AutomezzoForm();
        $filialiArray = $this->entityManager->getRepository(Filiale::class)->trovaFilialiOrdinateArray();
        $form->setFiliali($filialiArray);
        $form->createForm();
        $request = $this->getRequest();
        if ($request->isPost()){
            $inputFilter = new AutomezzoFormFilter();
            $form->setInputFilter($inputFilter->getInputFilter());
            $form->setData($request->getPost());
            if($form->isValid()){
                $data = $form->getData();
                $obj->setTarga($data['targa']);
                $obj->setMarca($data['marca']);
                $obj->setModello($data['modello']);
                $filialeObj = $filialiArray = $this->entityManager->getRepository(Filiale::class)->find($data['filiale']);
                if(!is_null($filialeObj)){
                    $obj->setFiliale($filialeObj);
                }

                $this->entityManager->persist($obj);

                $this->entityManager->flush();
                return $this->redirect()->toRoute('elenco_automezzi');

            }else{
                //form non valido
            }

        }else{
            //request non è post
            $form->setData(array(
                'targa'=>$obj->getTarga(),
                'marca'=>$obj->getMarca(),
                'modello'=>$obj->getModello(),
                'filiale'=>$obj->getFiliale()->getCodice(),
            ));
        }

        return new ViewModel([
            'form'=>$form,
            'obj'=>$obj
        ]);
    }

    public function cancellaAutomezzoAction()
    {
        $codice = (int)$this->params()->fromRoute('codice', -1);
        if ($codice<1) {
            $this->flashMessenger()->addErrorMessage('Errore');
            return $this->redirect()->toRoute('home');
        }

        $obj = $this->entityManager->getRepository(Automezzo::class)->find($codice);

        $form = new AutomezzoForm();
        $filialiArray = $this->entityManager->getRepository(Filiale::class)->trovaFilialiOrdinateArray();
        $form->setFiliali($filialiArray);
        $form->createForm();
        $request = $this->getRequest();
        if ($request->isPost()){
            $this->entityManager->remove($obj);
            $this->entityManager->flush();
            return $this->redirect()->toRoute('elenco_automezzi');
        }else{
            //request non è post
            $form->setData(array(
                'targa'=>$obj->getTarga(),
                'marca'=>$obj->getMarca(),
                'modello'=>$obj->getModello(),
                'filiale'=>$obj->getFiliale()->getCodice(),
            ));
        }

        return new ViewModel([
            'form'=>$form,
            'obj'=>$obj
        ]);
    }

}
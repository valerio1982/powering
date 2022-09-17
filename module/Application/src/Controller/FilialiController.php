<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;


use Application\Entity\Automezzo;
use Application\Entity\Filiale;
use Application\Form\FilialeForm;
use Application\InputFilter\FilialeFormFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;



/**
 * @author Ing. Giacinto Girelli
 * Class FilialiController
 * @package Application\Controller
 */
class FilialiController extends AbstractActionController
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

    public function elencoFilialiAction(){

        $filialiArray = $this->entityManager->getRepository(Filiale::class)->trovaFilialiArray();
        $jsonData = json_encode($filialiArray,JSON_HEX_APOS);

        return new ViewModel([
            'jsonData'=>$jsonData
        ]);
    }

    public function dettaglioFilialeAction()
    {
        $codice = (int)$this->params()->fromRoute('codice', -1);
        if ($codice<1) {
            $this->flashMessenger()->addErrorMessage('Errore');
            return $this->redirect()->toRoute('home');
        }

        $obj = $this->entityManager->getRepository(Filiale::class)->find($codice);
        $automezziArray = $this->entityManager->getRepository(Automezzo::class)->trovaAutomezziFilialeArray($codice);
        $jsonData = json_encode($automezziArray,JSON_HEX_APOS);

        return new ViewModel([
            'obj'=>$obj,
            'jsonData'=>$jsonData
        ]);
    }

    public function creaFilialeAction()
    {
        $form = new FilialeForm();
        $form->createForm();
        $request = $this->getRequest();
        if ($request->isPost()){
            $inputFilter = new FilialeFormFilter();
            $form->setInputFilter($inputFilter->getInputFilter());
            $form->setData($request->getPost());
            if($form->isValid()){
                $data = $form->getData();
                $obj = new Filiale();
                $obj->setIndirizzo($data['indirizzo']);
                $obj->setCitta($data['citta']);
                $obj->setCap($data['cap']);
                $this->entityManager->persist($obj);

                $this->entityManager->flush();
                return $this->redirect()->toRoute('elenco_filiali');

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

    public function modificaFilialeAction()
    {
        $codice = (int)$this->params()->fromRoute('codice', -1);
        if ($codice<1) {
            $this->flashMessenger()->addErrorMessage('Errore');
            return $this->redirect()->toRoute('home');
        }

        $obj = $this->entityManager->getRepository(Filiale::class)->find($codice);
        $form = new FilialeForm();
        $form->createForm();
        if(!is_null($obj)){
            $request = $this->getRequest();
            if ($request->isPost()){
                $inputFilter = new FilialeFormFilter();
                $form->setInputFilter($inputFilter->getInputFilter());
                $form->setData($request->getPost());
                if($form->isValid()){
                    $data = $form->getData();
                    $obj->setIndirizzo($data['indirizzo']);
                    $obj->setCitta($data['citta']);
                    $obj->setCap($data['cap']);
                    $this->entityManager->persist($obj);

                    $this->entityManager->flush();
                    return $this->redirect()->toRoute('elenco_filiali');

                }else{
                    //form non valido
                }

            }else{
                //request non è post
                $form->setData(array(
                    'indirizzo'=>$obj->getIndirizzo(),
                    'citta'=>$obj->getCitta(),
                    'cap'=>$obj->getCap(),
                ));
            }
        }else{
            $this->flashMessenger()->addErrorMessage('Filiale non trovata');
            return $this->redirect()->toRoute('elenco_filiali');
        }

        return new ViewModel([
            'form'=>$form,
            'obj'=>$obj
        ]);
    }

    public function cancellaFilialeAction()
    {
        $codice = (int)$this->params()->fromRoute('codice', -1);
        if ($codice<1) {
            $this->flashMessenger()->addErrorMessage('Errore');
            return $this->redirect()->toRoute('home');
        }

        $obj = $this->entityManager->getRepository(Filiale::class)->find($codice);
        $form = new FilialeForm();
        $form->createForm();
        if(!is_null($obj)){
            $request = $this->getRequest();
            if ($request->isPost()){
                $this->entityManager->remove($obj);
                $this->entityManager->flush();
                return $this->redirect()->toRoute('elenco_filiali');

            }else{
                //request non è post
                $form->setData(array(
                    'indirizzo'=>$obj->getIndirizzo(),
                    'citta'=>$obj->getCitta(),
                    'cap'=>$obj->getCap(),
                ));
            }
        }else{
            $this->flashMessenger()->addErrorMessage('Filiale non trovata');
            return $this->redirect()->toRoute('elenco_filiali');
        }

        return new ViewModel([
            'form'=>$form,
            'obj'=>$obj
        ]);

        return new ViewModel([]);
    }


}
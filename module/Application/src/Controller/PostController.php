<?php
namespace Application\Controller;

use Application\Entity\Automezzo;
use Application\Entity\Filiale;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Http\Client;
use Zend\Http\Request;

/**
 * @author Ing. Giacinto Girelli
 * Class PostController
 * @package Application\Controller
 */
class PostController extends AbstractActionController
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

    public function inviaAction(){
        $tipo = $this->params()->fromRoute('tipo', -1);
        if($tipo=='automezzo'){
            $url = "https://edoo.poweringsrl.it/exercises/Automezzo/upload.json";
            $automezziArray = $this->entityManager->getRepository(Automezzo::class)->trovaAutomezziArray();
            $body = json_encode(array("email"=>"mia_email@esempio.it","data"=>$automezziArray),JSON_HEX_APOS);

        }else{
            $url = "https://edoo.poweringsrl.it/exercises/Filiale/upload.json";
            $filialiArray = $this->entityManager->getRepository(Filiale::class)->trovaFilialiArray();
            $body = json_encode(array("email"=>"mia_email@esempio.it","data"=>$filialiArray),JSON_HEX_APOS);
        }
        //error_log($body);

        $res = $this->inviarequest($url,$body);
        if($res!=''){

        }
        //return $this->redirect()->toRoute('chiamata_http');
        return new ViewModel([
            'risposta'=>$res,
            'tipo'=>$tipo

        ]);
    }


    public function inviarequest($url,$body)
    {
        $servizioReturn = "";
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_SSL_VERIFYHOST =>false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //echo "cURL Error #:" . $err;
            //error_log("cURL Error #:" . $err);
            $servizioReturn = '{"message":"Errore Upload"}';

        } else {
            //error_log($response);
            //echo $response;
            $servizioReturn= $response;
        }

        return $servizioReturn;
    }

}
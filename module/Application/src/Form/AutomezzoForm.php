<?php


namespace Application\Form;


use Zend\Form\Form;

class AutomezzoForm extends Form
{

    protected $filiali;

    public function setFiliali($filiali){
        if(!empty($filiali)){
            foreach ($filiali as $ele){
                //error_log(print_r($ele,true));
                $this->filiali[$ele['codice']]  = $ele['codice'].' - '.$ele['indirizzo'];
            }
        }
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct('automezzo-form');

        $this->setAttribute('method', 'post');

        $this->setAttribute('enctype', 'multipart/form-data');

    }


    public function createForm()
    {

        $this->add(array(
            'name' => 'targa',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
                'suggerimento' =>'(Targa)',
            ),
            'options' => array(
                'label' => 'Targa',
            ),
        ));
        $this->add(array(
            'name' => 'marca',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
                'suggerimento' =>'(Marca)',
            ),
            'options' => array(
                'label' => 'Marca',
            ),
        ));
        $this->add(array(
            'name' => 'modello',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
                'suggerimento' =>'(Modello)',
            ),
            'options' => array(
                'label' => 'Modello',
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'filiale',
            'options' => array(
                'label' => 'Filiale',
                'empty_option' => 'Selezionare...',
                'value_options' => $this->filiali,
            ),
            'attributes' => array(
                'value' => '0', // set unchecked
                'class' => 'form-control',
                'suggerimento' =>'(Filiale di appartenenza)',
            )
        ));


        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Conferma',
                'id' => 'submitbutton',
                'class'=>'btn btn-primary',
            ],
        ]);

    }

}
<?php


namespace Application\Form;


use Zend\Form\Form;

class FilialeForm extends Form
{

    /**
     * Constructor.
     */
    public function __construct()
    {

        parent::__construct('filiale-form');

        $this->setAttribute('method', 'post');

        $this->setAttribute('enctype', 'multipart/form-data');

    }


    public function createForm()
    {

        $this->add(array(
            'name' => 'indirizzo',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
                'suggerimento' =>'(Via e numero civico della filiale)',
            ),
            'options' => array(
                'label' => 'Indirizzo',
            ),
        ));

        $this->add(array(
            'name' => 'citta',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
                'suggerimento' =>'(Città della filiale)',
            ),
            'options' => array(
                'label' => 'Città',
            ),
        ));

        $this->add(array(
            'name' => 'cap',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control',
                'suggerimento' =>'(CAP della filiale)',
            ),
            'options' => array(
                'label' => 'Cap',
            ),
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
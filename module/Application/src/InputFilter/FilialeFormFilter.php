<?php


namespace Application\InputFilter;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class FilialeFormFilter implements InputFilterAwareInterface
{
    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @var Repository
     */
    protected $repository;

    /**
     * Appends doctrine's repository.
     *
     * @access public
     * @param \Doctrine\ORM\EntityRepository $repository
     */
    public function setRepository(\Doctrine\ORM\EntityRepository $repository)
    {
        $this->repository = $repository;
    }


    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception('Not used');
    }


    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();


            $inputFilter->add($factory->createInput(array(
                'name'     => 'indirizzo',
                'required' => true,
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 100
                        ],
                    ],
                ],
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'citta',
                'required' => true,
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 50
                        ],
                    ],
                ],
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'cap',
                'required' => true,
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 5
                        ],
                    ],
                ],
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
            )));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
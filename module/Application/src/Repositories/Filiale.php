<?php
namespace Application\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class Filiale extends EntityRepository
{

    public function trovaFilialiArray()
    {
        $sql = "SELECT *  FROM filiale";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function trovaFilialiOrdinateArray()
    {
        $sql = "SELECT *  FROM filiale ORDER BY codice ASC";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
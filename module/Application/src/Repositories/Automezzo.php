<?php
namespace Application\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class Automezzo extends EntityRepository
{
    public function trovaAutomezziArray()
    {

        //$sql = "SELECT *  FROM automezzo";
        $sql = "SELECT a.codice, a.targa, a.marca, a.modello, CONCAT(f.codice, \" - \", f.indirizzo, \" (\",f.citta,\")\") as filiale 
                FROM automezzo a LEFT JOIN filiale f ON a.filiale=f.codice";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function trovaAutomezziFilialeArray($codice)
    {

        //$sql = "SELECT *  FROM automezzo";
        $sql = "SELECT a.codice, a.targa, a.marca, a.modello, CONCAT(f.codice, \" - \", f.indirizzo, \" (\",f.citta,\")\") as filiale 
                FROM automezzo a LEFT JOIN filiale f ON a.filiale=f.codice
                WHERE a.filiale=$codice";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

}
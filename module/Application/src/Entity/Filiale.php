<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filiale
 *
 * @ORM\Entity(repositoryClass="Application\Repositories\Filiale")
 * @ORM\Table(name="filiale")
 * @ORM\Entity
 */
class Filiale
{
    /**
     * @var int
     *
     * @ORM\Column(name="codice", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="indirizzo", type="string", length=100, nullable=true)
     */
    private $indirizzo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="citta", type="string", length=50, nullable=true)
     */
    private $citta;



    /**
     * @var string|null
     *
     * @ORM\Column(name="cap", type="string", length=5, nullable=true)
     */
    private $cap;



    /**
     * Get codice.
     *
     * @return int
     */
    public function getCodice()
    {
        return $this->codice;
    }



    /**
     * Set cap.
     *
     * @param string|null $cap
     *
     * @return Filiale
     */
    public function setCap($cap = null)
    {
        $this->cap = $cap;

        return $this;
    }

    /**
     * Get cap.
     *
     * @return string|null
     */
    public function getCap()
    {
        return $this->cap;
    }


    /**
     * Set indirizzo.
     *
     * @param string|null $indirizzo
     *
     * @return Filiale
     */
    public function setIndirizzo($indirizzo = null)
    {
        $this->indirizzo = $indirizzo;

        return $this;
    }

    /**
     * Get indirizzo.
     *
     * @return string|null
     */
    public function getIndirizzo()
    {
        return $this->indirizzo;
    }

    /**
     * Set citta.
     *
     * @param string|null $citta
     *
     * @return Filiale
     */
    public function setCitta($citta = null)
    {
        $this->citta = $citta;

        return $this;
    }

    /**
     * Get citta.
     *
     * @return string|null
     */
    public function getCitta()
    {
        return $this->citta;
    }

}

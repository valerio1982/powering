<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Automezzo
 *
 * @ORM\Entity(repositoryClass="Application\Repositories\Automezzo")
 * @ORM\Table(name="automezzo", indexes={@ORM\Index(name="fk_filiale", columns={"filiale"})})
 * @ORM\Entity
 */
class Automezzo
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
     * @ORM\Column(name="marca", type="string", length=50, nullable=true)
     */
    private $marca;

    /**
     * @var string|null
     *
     * @ORM\Column(name="targa", type="string", length=7, nullable=true)
     */
    private $targa;



    /**
     * @var string|null
     *
     * @ORM\Column(name="modello", type="string", length=50, nullable=true)
     */
    private $modello;



    /**
     * @var \Application\Entity\Filiale
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Filiale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="filiale", referencedColumnName="codice")
     * })
     */
    private $filiale;

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
     * Set targa.
     *
     * @param string|null $targa
     *
     * @return Automezzo
     */
    public function setTarga($targa = null)
    {
        $this->targa = $targa;

        return $this;
    }

    /**
     * Get targa.
     *
     * @return string|null
     */
    public function getTarga()
    {
        return $this->targa;
    }

    /**
     * Set marca.
     *
     * @param string|null $marca
     *
     * @return Automezzo
     */
    public function setMarca($marca = null)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca.
     *
     * @return string|null
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modello.
     *
     * @param string|null $modello
     *
     * @return Automezzo
     */
    public function setModello($modello = null)
    {
        $this->modello = $modello;

        return $this;
    }

    /**
     * Get modello.
     *
     * @return string|null
     */
    public function getModello()
    {
        return $this->modello;
    }


    /**
     * Set filiale.
     *
     * @param \Application\Entity\Filiale|null $filiale
     *
     * @return Filiale
     */
    public function setFiliale(\Application\Entity\Filiale $filiale = null)
    {
        $this->filiale = $filiale;

        return $this;
    }

    /**
     * Get filiale.
     *
     * @return \Application\Entity\Filiale|null
     */
    public function getFiliale()
    {
        return $this->filiale;
    }
}

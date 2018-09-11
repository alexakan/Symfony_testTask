<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * States
 *
 * @ORM\Table(name="states")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatesRepository")
 */
class States
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="state_title", type="string", length=255)
     */
    private $stateTitle;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set stateTitle
     *
     * @param string $stateTitle
     *
     * @return States
     */
    public function setStateTitle($stateTitle)
    {
        $this->stateTitle = $stateTitle;

        return $this;
    }

    /**
     * Get stateTitle
     *
     * @return string
     */
    public function getStateTitle()
    {
        return $this->stateTitle;
    }
}


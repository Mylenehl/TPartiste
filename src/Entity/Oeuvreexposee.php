<?php

namespace App\Entity;

use App\Repository\OeuvreexposeeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OeuvreexposeeRepository::class)
 */
class Oeuvreexposee
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id_exposition;

    public function getId_exposition(): ?int
    {
        return $this->id_exposition;
    }

     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id_oeuvre;

    public function getId_oeuvre(): ?int
    {
        return $this->id_oeuvre;
    }

}
<?php

namespace App\Controller;

use App\Entity\Exposition;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
   /**
     * @Route("/", name="accueil")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Exposition::class);
        $expositions = $repo->findBy([], ['id'=>'DESC'], 3);

        return $this->render('accueil/index.html.twig', ['lestroisder' => $expositions]);
    }
}
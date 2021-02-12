<?php

namespace App\Controller;

use App\Entity\Exposition;
use App\Entity\Oeuvreexposee;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ExpositionsController extends AbstractController
{
    /**
     * @Route("/expositions", name="expositions")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Exposition::class);
        $expositions = $repo->findAll();

        return $this->render('expositions/index.html.twig', ['expositions' => $expositions]);
    }
    
    /**
     * @Route("/expositions/create", name="app_exposition_create", methods={"GET","POST"})
     */
    public function createO(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createFormBuilder()
            ->add('nom', TextType::class)
            ->add('lieu', TextType::class)
            ->add('adresse', TextType::class)
            ->add('date_debut', DateType::class)
            ->add('date_fin', DateType::class)
            ->add('date_vernissage', DateTimeType::class)
            ->add('Ajouter', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form ->isValid()){
            $data =$form->getData();

            $exposition = new Exposition;
            $exposition->setNom($data['nom']);
            $exposition->setLieu($data['lieu']);
            $exposition->setAdresse($data['adresse']);
            $exposition->setDateDebut($data['date_debut']);
            $exposition->setDateFin($data['date_fin']);
            $exposition->setDateVernissage($data['date_vernissage']);

            $em->persist($exposition);
            $em->flush($exposition);

            return $this ->redirectToRoute('expositions');
        }
        
        return $this->render('expositions/create.html.twig', ['formExposition'=>$form->createView()]);
    }
    
    /**
     * @Route("/expo", name="expo")
     */

    public function oe (EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Exposition::class);
        $expositionciblee = $repo->find($_GET['id']);

        $repo2 = $em->getRepository(Oeuvreexposee::class);
        $oeuvredelexpo = $repo2->jointure($_GET['id']);

        return $this->render('expositions/expo.html.twig',['expositionciblee'=>$expositionciblee, 'oeuvredelexpo'=>$oeuvredelexpo]);
    }
}
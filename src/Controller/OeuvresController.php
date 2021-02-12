<?php

namespace App\Controller;

use App\Entity\Oeuvre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OeuvresController extends AbstractController
{
    /**
     * @Route("/oeuvres", name="oeuvres")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Oeuvre::class);
        $oeuvres = $repo->findAll();

        return $this->render('oeuvres/index.html.twig', ['oeuvres' => $oeuvres]);
    }
    
    /**
     * @Route("/oeuvres/create", name="app_oeuvre_create", methods={"GET","POST"})
     */
    public function createO(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createFormBuilder()
            ->add('titre', TextType::class)
            ->add('annee', IntegerType::class)
            ->add('technique', TextType::class)
            ->add('support', TextType::class)
            ->add('largeur', IntegerType::class)
            ->add('hauteur', IntegerType::class)
            ->add('prix', IntegerType::class)
            ->add('petite_image', TextType::class)
            ->add('grande_image', TextType::class)
            ->add('Ajouter', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form ->isValid()){
            $data =$form->getData();

            $oeuvre = new Oeuvre;
            $oeuvre->setTitre($data['titre']);
            $oeuvre->setAnnee($data['annee']);
            $oeuvre->setTechnique($data['technique']);
            $oeuvre->setSupport($data['support']);
            $oeuvre->setLargeur($data['largeur']);
            $oeuvre->setHauteur($data['hauteur']);
            $oeuvre->setPrix($data['prix']);
            $oeuvre->setPetiteImage($data['petite_image']);
            $oeuvre->setGrandeImage($data['grande_image']);

            $em->persist($oeuvre);
            $em->flush($oeuvre);

            return $this ->redirectToRoute('oeuvres');
        }
        
        return $this->render('oeuvres/create.html.twig', ['formOeuvre'=>$form->createView()]);
    }
    /**
     * @Route("/oeuvre", name="oeuvre")
     */
    public function oeuvresolo(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Oeuvre::class);
        $oeuvre = $repo->find($_GET['id']);

        return $this->render('oeuvres/oeuvre.html.twig', ['oeuvre' => $oeuvre]);
    }
}
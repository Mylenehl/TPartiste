<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @Route("/member", name="member")
     */
    public function index(): Response
    {
        return $this->render('member/index.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }
    /**
     * @Route("/member/create", name="member_create", methods={"GET","POST"})
     */
    public function createMember(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createFormBuilder()
            ->add('username', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
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
}

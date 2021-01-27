<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjectType;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(ProjetRepository $projetRepository): Response
    {
        $projets=$projetRepository->findAll();
        return $this->render('home/index.html.twig',[
      
          'projets'=>$projets
        ]);
    }
    
    /**
     * @Route("home/administration", name="admin")
     */
public function new(Request $request,ProjetRepository $projetRepository){
  $projects= new Projet();
  $form =$this->createForm(ProjectType::class,$projects);
  $form->handleRequest($request);
  $projets=$projetRepository->findAll();
  if($form->isSubmitted() && $form->isValid()){
 $entityManager =$this->getDoctrine()->getManager();
 $entityManager->persist($projects);
 $entityManager->flush();
 return $this->redirectToRoute('projet_edit');
  }
  return $this->render('home/home.html.twig',[
    'form'=>$form->createView(),
    'projets'=>$projets
  ]);

}


/**
     * @Route("home/administration/edit/{id}", name="projet_edit")
     */
     
     public function edit(Request $request, Projet $projects):Response{
       
      $entityManager = $this->getDoctrine()->getManager();
       
       
      $form =$this->createForm(ProjectType::class,$projects);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
      
     $entityManager->persist($projects);
     $entityManager->flush();
     return $this->redirectToRoute('home');
     

      }
       



      return $this->render('home/edit.html.twig',[
        'editForm'=>$form->createView()]);
     }

   /**
 * @Route("home/administration/delete/{id}", name="delete_projet")
 */
public function delete(Request $request, Projet $projects):Response{
   
  $entityManager = $this->getDoctrine()->getManager();
   
   
  
   
  
 $entityManager->remove($projects);
 $entityManager->flush();
 return $this->redirectToRoute('home');
 

  
  
}




  
}
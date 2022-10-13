<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    #[Route('/addClassroom', name: 'add_Classroom')]
    public function addClassroom(ManagerRegistry  $doctrine)
    {
        $classroom= new Classroom();
        $classroom->setName("3A31");
        $classroom->setNbrStudent("35");
        $em= $doctrine->getManager();
        $em->persist($classroom);
        $em->flush();
        //return $this->redirectToRoute("")
        return new Response("add Classroom");
    }

    #[Route('/addClassroomForm', name: 'addClassroomForm')]
    public function addClassroomForm(Request  $request,ManagerRegistry $doctrine)
    {
        $classroom= new  Classroom();
        $form= $this->createForm(ClassroomType::class,$classroom);
        $form->handleRequest($request) ;
        if ($form->isSubmitted()){
             $em= $doctrine->getManager();
             $em->persist($classroom);
             $em->flush();
             return  $this->redirectToRoute("addClassroomForm");
         }
        return $this->renderForm("Classroom/add.html.twig",array("FormClassroom"=>$form));
    }
    



    #[Route('/updateClassroomForm/{id}', name: 'updateClassroomForm')]
    public function updateClassroomForm($id,ClassroomRepository $repository ,Request  $request,ManagerRegistry $doctrine)
    {
        $classroom= $repository-> find($id);
        $form= $this->createForm(ClassroomType::class,$classroom);
        $form->handleRequest($request) ;
        if ($form->isSubmitted()){
             $em= $doctrine->getManager();
             $em->flush();
             return  $this->redirectToRoute("addClassroomForm");
         }
        return $this->renderForm("Classroom/update.html.twig",array("FormClassroom"=>$form));
    }


    #[Route('/removeclassroom/{id}', name: 'remove_classroom')]
    public function remove(ManagerRegistry $doctrine,$id,ClassroomRepository $repository)
    {
        $classroom= $repository->find($id);
        $em= $doctrine->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute("addClassroomForm");
    }


    #[Route('/listClassroom', name: 'listClassroom')]
    public function listClassroom(ClassroomRepository  $repository)
    {
        $classroom= $repository->findAll();
        return $this->render("classroom/list.html.twig",array("tabClassroom"=>$classroom));
    }



















}

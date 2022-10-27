<?php

namespace App\Controller;
use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }


    #[Route('/addStudentForm', name: 'addStudentForm')]
    public function addStudentForm(StudentRepository $repository,Request  $request,ManagerRegistry $doctrine)
    {
        $student= new  Student();
        $form= $this->createForm(StudentType::class,$student);
        $form->handleRequest($request) ;
        if ($form->isSubmitted()){
            $repository->add($student,true);
             return  $this->redirectToRoute("addStudentForm");
         }
        return $this->renderForm("student/add.html.twig",array("FormStudent"=>$form));
    }
    




    /*#[Route('/list', name: 'app_pizza')]
    public function list(){
        return $this->render('student/liste.html.twig');
    }*/


    #[Route('/student', name: 'app_student')]
    public function lists(StudentRepository $repository){
        $students=$repository->findAll();
        $sortbycin=$repository->sortbycin();
        $topstudent=$repository->topStudent();
        return $this->render('student/lists.html.twig',array('student'=>$students,'sortbycin'=> $sortbycin,'topstudent'=>$topstudent));
    }

    
}

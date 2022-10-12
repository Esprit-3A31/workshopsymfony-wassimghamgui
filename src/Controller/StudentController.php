<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }


    #[Route('/add/{var}', name: 'app_pizza')]

    public function addpizza($var){
        return new Response("pizza".$var);
    }




    #[Route('/list', name: 'app_pizza')]
    public function list(){
        return $this->render('student/liste.html.twig');
    }


    #[Route('/student', name: 'app_student')]
    public function lists(StudentRepository $repository){
        $students=$repository->findAll();
        return $this->render('student/lists.html.twig',array('student'=>$students));
    }


}

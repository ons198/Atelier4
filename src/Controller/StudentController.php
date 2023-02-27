<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry; 
 use App\Entity\Student;
class StudentController extends AbstractController
{
   /* #[Route('/student', name: 'app_student')]
    public function index(StudentRepository $repo): Response
    {  
        $students =$repo ->findAll();
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
            'students'=>$students
        ]);
    }*/
    
    #[Route('/student', name: 'app_student')]
    public function index(ManagerRegistry $doctrine): Response
    {  
        $repo =$doctrine ->getRepository(student :: class);
        $students =$repo ->FindAll();

        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
            'students'=>$students
        ]);
    }

    #[Route('/deleteStudent/{id}', name: 'delete_student')]
    public function deleteStudent($id , ManagerRegistry $doctrine){
        $student=$doctrine->getRepository(Student::class) ->Find($id);
        $en=$doctrine->getManager();
        $en->remove($student);
        $en->flush();
        return $this->redirectToRoute('app_student');


    }

    #[Route('/addStudent', name: 'add_student')]
    public function addStudent( ManagerRegistry $doctrine){
        $student = new Student();
        $student->setUsername('test persist');
        $student->setEmail('persist@test.com');
        $en=$doctrine->getManager();
        $en->remove($student);
        $en->flush();
        return $this->redirectToRoute('app_student');
    }

}

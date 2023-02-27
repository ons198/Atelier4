<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry; 
 use App\Entity\Classroom;
class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(ManagerRegistry $doctrine): Response
    {
        
        $repo =$doctrine ->getRepository(classroom :: class);
        $classroom =$repo ->FindAll();

        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
            'classroom'=>$classroom
        ]);
    }

    #[Route('/addClassroom', name: 'add_classroom')]
    public function addClassroom(  ManagerRegistry $doctrine){
        $classroom = new Classroom();
        $classroom->setName('ons');
        $en=$doctrine->getManager();
        $en->flush();
        return $this->redirectToRoute('app_classroom');
    }

    #[Route('/list',name:"list_classroom")]
    public function list (): Response
    {
          $classroom = array(
            array('id' => '1', 'name' => '2A28') ,
            array('id' => '2', 'name' => '3B16'),
            array('id' => '3', 'name' => '5A12'),
            array('id' => '4', 'name' => '3A26'),
            array('id' => '5', 'name' => '3P11'),
            array('id' => '6', 'name' => '3A1'),
            array('id' => '7', 'name' => '2A28'),
            array('id' => '8', 'name' => '3B16'),


          );
                  return $this ->render('classroom/list.html.twig',[
                      'tabclassroom'=>$classroom
          ]);
    }

     

        
    #[Route('/updateClassroom', name: 'update_classroom')]
    public function updateClassroom(  ManagerRegistry $doctrine){
        $classroom = new Classroom();
        return $this ->render('classroom/modifier.html.twig',[
            'tabclassroom'=>$classroom
]);
    }

    #[Route('/deleteClassroom/{id}', name: 'delete_classroom')]
    public function deleteClassroom($id , ManagerRegistry $doctrine){
        $classroom=$doctrine->getRepository(Classroom::class) ->Find($id);
        $en=$doctrine->getManager();
        $en->remove($classroom);
        $en->flush();
        return $this->redirectToRoute('list');


    }

}

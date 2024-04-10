<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager= $entityManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        //$project = $this->entityManager->getRepository(Project::class)->find(rand(1,7));
        //$project->setName('New Name_' . time());
        //$this->entityManager->flush($project);
        //return new Response($project->getId());

        //$status = ['NEW', 'PENDING', 'COMPLETED', 'CANCELED'];
        //$type = ['UPLOAD', 'QUESTION', 'VOTE', 'REVIEW'];

        $task = $this->entityManager->getRepository(Task::class)->find(rand(1,22));
        $task->setName('New_Name_' . time());
        $this->entityManager->flush($task);
        //$task->setStatus($status[array_rand($status)]);
        //$task->setType($type[array_rand($type)]);
        //$this->entityManager->persist($task);
        //$this->entityManager->flush();
        return new Response($task->getId());
    }
}

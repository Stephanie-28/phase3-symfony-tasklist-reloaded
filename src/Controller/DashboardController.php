<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\Folder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // SELECT toutes les tâches
        $tasks = $entityManager->getRepository(Task::class)->findAll();

        // SELECT tous les dossiers
        $folders = $entityManager->getRepository(Folder::class)->findAll();

        return $this->render('dashboard/index.html.twig', [
            'tasks' => $tasks,
            'folders' => $folders,
        ]);
    }
}

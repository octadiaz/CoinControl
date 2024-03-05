<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnalisisController extends AbstractController
{
    #[Route('/analisis', name: 'app_analisis')]
    public function index(): Response
    {
        return $this->render('analisis/analisis.html.twig', [
            'controller_name' => 'AnalisisController',
        ]);
    }
}

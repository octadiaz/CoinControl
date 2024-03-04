<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ResumenController extends AbstractController
{
    #[Route('/resumen', name: 'app_resumen')]
    public function index(): Response
    {
        return $this->render('resumen/resumen.html.twig', [
            'controller_name' => 'ResumenController',
        ]);
    }
}

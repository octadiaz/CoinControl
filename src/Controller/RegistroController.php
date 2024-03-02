<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'app_registro')]
    public function index(): Response
    {
        return $this->render('registro/registro.html.twig', [
            'controller_name' => 'RegistroController',
        ]);
    }
}

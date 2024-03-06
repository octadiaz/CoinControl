<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Cliente;
use App\Form\ClienteType;


class ClienteController extends AbstractController
{
    #[Route('/cliente', name: 'app_cliente')]
    public function index(): Response
    {
        return $this->render('cliente/cliente.html.twig', [
            'controller_name' => 'ClienteController',
        ]);
    }
}

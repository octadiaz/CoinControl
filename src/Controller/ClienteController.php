<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Cliente;
use Doctrine\ORM\EntityManagerInterface;



class ClienteController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/cliente', name: 'app_cliente')]
    public function index(): Response
    {
        return $this->render('cliente/cliente.html.twig', [
            'controller_name' => 'AnalisisController',
        ]);
    }

}

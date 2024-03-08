<?php

namespace App\Controller;

use App\Entity\Transaccion;
use DateTime;
use App\Entity\Categoria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class TransaccionController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/transaccion', name: 'agregar_trans', methods: ['GET', 'POST'])]
    public function añadirTransaccion(Request $request): Response
    {
        return $this->render('transaccion/transaccion.html.twig');
    }
}


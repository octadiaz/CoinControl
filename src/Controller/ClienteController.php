<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Cliente;
use App\Entity\Transaccion;
use Doctrine\ORM\EntityManagerInterface;



class ClienteController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/cliente', name: 'app_cliente')]
    public function mostrarDatos(): Response
    {
        $cliente = $this->getUser();
        $saldo = $cliente->getSaldo();
        
            
            $transaccionesRepository = $this->entityManager->getRepository(Transaccion::class);
            $transacciones = $transaccionesRepository->findBy(['cliente_transaccion' => $cliente->getId()]);
            

            return $this->render('cliente/cliente.html.twig', [
            'saldo' => $saldo, 'transacciones' => $transacciones
        ]);
    }
    

}

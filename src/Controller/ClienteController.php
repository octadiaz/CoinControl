<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Cliente;
use Doctrine\ORM\EntityManagerInterface;



// class ClienteController extends AbstractController
// {
//     private $entityManager;

    // public function __construct(EntityManagerInterface $entityManager)
    // {
    //     $this->entityManager = $entityManager;
    // }

    // #[Route('/cliente', name: 'agregar_saldo')]
    // public function añadirSaldo($id): Response
    // {
    //     // Obtener el repositorio de la entidad Cliente
    //     $cliente = $this->entityManager->getRepository(Cliente::class)->find($id);
    
    //     // Verificar si el cliente existe
    //     if (!$cliente) {
    //         throw $this->createNotFoundException('El cliente no existe');
    //         }
            
    //     $cliente->setSaldo('50000');
        
    //     // Persistir la transacción en la base de datos
    //     $this->entityManager->persist($cliente);
    //     $this->entityManager->flush();

    //     return $this->redirectToRoute('/cliente/cliente.html.twig');
    // }
    
    // #[Route('/cliente', name:'mostrar_saldo')]
    // public function obtenerSaldo(Request $id): Response
    // {
    //     // Obtener el repositorio de la entidad Cliente
    //     $cliente = $this->entityManager->getRepository(Cliente::class)->find($id);

    //     // Verificar si el cliente existe
    //     if (!$cliente) {
    //         throw $this->createNotFoundException('El cliente no existe');
    //     }

    //     // Obtener el saldo del cliente
    //     $saldo = $cliente->getSaldo();

    //     // Mostrar el saldo en una plantilla Twig
    //     return $this->render('cliente/cliente.html.twig', [
    //         'saldo' => $saldo
    //     ]);
    // }
// }

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Transaccion;
use App\Entity\Cliente;


class AnalisisController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/analisis', name: 'app_analisis')]
    public function mostrarAnalisis(): Response
    {
        $cliente = $this->getUser();
        $transaccionesRepository = $this->entityManager->getRepository(Transaccion::class);
        $transacciones = $transaccionesRepository->findBy(['cliente_transaccion' => $cliente->getId()]);

        // Obtener el nombre de cada tipo de categoría y el monto total gastado en cada una de ellas
        $categoriasData = [];
        foreach ($transacciones as $transaccion) {
        $categoria = $transaccion->getCategoria();
        $categoriaNombre = $categoria->getTipo();
        $monto = $transaccion->getMonto();

        if (!isset($categoriasData[$categoriaNombre])) {
            $categoriasData[$categoriaNombre] = 0;
        }

        $categoriasData[$categoriaNombre] += $monto;
        }

        return $this->render('analisis/analisis.html.twig', [
            'transacciones' => $transacciones,
            'categoriasData' => $categoriasData
        ]);
    }
}

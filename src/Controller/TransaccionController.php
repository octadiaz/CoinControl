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
        // Si el formulario ha sido enviado
        if ($request->isMethod('POST')) {
            // Obtiene los datos del formulario
            $nombre = $request->request->get('nombre');
            $fecha = new DateTime($request->request->get('fecha'));
            $categoria = $request->request->get('tipo_categorias');
            $monto = $request->request->get('monto');
            $comentario = $request->request->get('comentario');
            
            $cliente = $this->getUser();
            
            // Obtiene el saldo disponible del cliente
            $saldoDisponible = $cliente->getSaldo();
            
            
            // Verifica si el monto de la transacción es mayor que el saldo disponible
            if ($monto > $saldoDisponible) {
            $this->addFlash('error1', 'No tienes suficiente saldo para realizar esta transacción');
            return $this->redirectToRoute('agregar_trans');
            }

            if ($nombre && $fecha && $categoria && $monto)
            {

            if ($monto <= $saldoDisponible && $monto > 0) {
                $this->addFlash('exito1', 'Transacción exitosa');
                
                
                // Crea una nueva instancia de Transaccion y establece sus propiedades
                $transaccion = new Transaccion();
                $transaccion->setNombre($nombre);
                $transaccion->setFecha($fecha);
                $transaccion->setMonto($monto);
                $transaccion->setComentario($comentario);
                $transaccion->setClienteTransaccion($cliente);

                // Valida que la categoria ingresada coincida con la guardada en el repositorio
                // y se la asigna al objeto transaccion
                $categoriaEntity = $this->entityManager->getRepository(Categoria::class)->find($categoria);
                if ($categoriaEntity) {
                    $transaccion->setCategoria($categoriaEntity);
                }
            

                // Actualiza el saldo del cliente
                $saldoActual = $cliente->getSaldo();
                $nuevoSaldo = $saldoActual - $monto;
                $cliente->setSaldo($nuevoSaldo);

                // Carga los datos en la base de datos
                $this->entityManager->persist($transaccion);
                $this->entityManager->flush();
            
                return $this->redirectToRoute('agregar_trans');
                }


            } else{
                // Si el usuario ya existe, muestra un mensaje de error
                $this->addFlash('complete1', 'Complete los campos necesarios');
                return $this->redirectToRoute('agregar_trans');
            }
            
                return $this->redirectToRoute('app_cliente');
            }
        

        return $this->render('transaccion/transaccion.html.twig');
    }
}



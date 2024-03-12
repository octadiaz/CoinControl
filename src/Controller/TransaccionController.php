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
        if ($request->isMethod('POST')) {
            // Obtener los datos del formulario
            $nombre = $request->request->get('nombre');
            $fecha = new DateTime($request->request->get('fecha'));
            $categoria = $request->request->get('tipo_categorias');
            $monto = $request->request->get('monto');
            $comentario = $request->request->get('comentario');
            
            $cliente = $this->getUser();
            
            // Obtener el saldo disponible del cliente
            $saldoDisponible = $cliente->getSaldo();
            
            
            // Verificar si el monto de la transacción es mayor que el saldo disponible
            if ($monto > $saldoDisponible) {
            $this->addFlash('error1', 'No tienes suficiente saldo para realizar esta transacción');
            return $this->redirectToRoute('agregar_trans');
            }

            if ($nombre && $fecha && $categoria && $monto)
            {

            if ($monto <= $saldoDisponible && $monto > 0) {
                $this->addFlash('exito1', 'Transacción exitosa');
                
                
                // Crear una nueva instancia de Transaccion y establecer sus propiedades
                $transaccion = new Transaccion();
                $transaccion->setNombre($nombre);
                $transaccion->setFecha($fecha);
                $transaccion->setMonto($monto);
                $transaccion->setComentario($comentario);
                $transaccion->setClienteTransaccion($cliente);

                // Si tienes la entidad Categoria, puedes asignarla a la transacción
                // Asumiendo que el valor de $categoria es el id de la categoría
                $categoriaEntity = $this->entityManager->getRepository(Categoria::class)->find($categoria);
                if ($categoriaEntity) {
                    $transaccion->setCategoria($categoriaEntity);
                }
            

                // Actualizar el saldo del cliente
                $saldoActual = $cliente->getSaldo();
                $nuevoSaldo = $saldoActual - $monto;
                $cliente->setSaldo($nuevoSaldo);

                // Persistir los datos en la base de datos
                $this->entityManager->persist($transaccion);
                $this->entityManager->flush();
            
                return $this->redirectToRoute('agregar_trans');
                }


            } else{
                // Si el usuario ya existe, muestra un mensaje de error
                $this->addFlash('complete1', 'Complete los campos necesarios');
                return $this->redirectToRoute('agregar_trans');
            }
            
            // Redirigir a alguna página de confirmación o a la página de inicio
                return $this->redirectToRoute('app_cliente');
            }
        

        return $this->render('transaccion/transaccion.html.twig');
    }
}



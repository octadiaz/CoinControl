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


// class TransaccionController extends AbstractController
// {
//     private $entityManager;

//     public function __construct(EntityManagerInterface $entityManager)
//     {
//         $this->entityManager = $entityManager;
//     }

//     #[Route('/transaccion', name: 'agregar_trans', methods: ['GET', 'POST'])]
//     public function añadirTransaccion(Request $request): Response
//     {
//         // Si el formulario ha sido enviado
//         if ($request->isMethod('POST')) {
//             // Obtener los datos del formulario usando el componente Request de Symfony
//             $nombre = $request->request->get('nombre');
//             $fechaTexto = $request->request->get('fecha');
//             $fecha = DateTime::createFromFormat('Y-m-d\TH:i', $fechaTexto);
//             $categorias = $request->request->get('tipo_categorias');
//             $monto = $request->request->get('monto');
//             $comentario = $request->request->get('comentario');

//             // Crear instancias de Transaccion y Categoria
//             $transaccion = new Transaccion();
//             $categoria = new Categoria();

//             // Asignar valores a las entidades
//             $transaccion->setNombre($nombre);
//             $transaccion->setFecha($fecha);
//             $categoria->setTipo($categorias);
//             $transaccion->setMonto($monto);
//             $transaccion->setComentario($comentario);

//             // Asociar la categoría a la transacción
//             $transaccion->addCategoria($categoria);

//             // Persistir la transacción en la base de datos
//             $this->entityManager->persist($transaccion);
//             $this->entityManager->flush();

//             // Redirigir a alguna página de confirmación o a la página de inicio
//             return $this->render('cliente/cliente.html.twig');

//         }

//         // Renderizar la página Twig para cargar perfiles
//         return $this->render('transaccion/transaccion.html.twig');
//     }
// }


<?php

namespace App\Controller;

use App\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class RegistroController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    
    #[Route("/registro", name :"registro_u", methods: ["GET", "POST"])]
    public function registroUsuario(Request $request): Response
    {
        // Si el formulario ha sido enviado
        if ($request->isMethod('POST'))
        {
            // Obtener los datos del formulario
            $nombre = $request->request->get('nombre');
            $apellido = $request->request->get('apellido');
            $mail = $request->request->get('mail');
            $dni = $request->request->get('dni');
            $user = $request->request->get('user');
            $password = $request->request->get('pass');
            $cliente = new Cliente();
            $cliente->setNombre($nombre);
            $cliente->setApellido($apellido);
            $cliente->setEmail($mail);
            $cliente->setDni($dni);
            $cliente->setUsername($user);
            $cliente->setPassword($password);

            // Persistir los datos en la base de datos
            $this->entityManager->persist($cliente);
            $this->entityManager->flush();

            $this->addFlash('exito', 'Se ha registrado exitosamente');

            // Redirigir a alguna página de confirmación o a la página de inicio
            return $this->render('registro/registro.html.twig');

        }
        // Renderizar la página Twig para cargar perfiles
        return $this->render('registro/registro.html.twig');
    }

    #[Route('/ingreso', name:'ingreso_u', methods: ['GET', "POST"])]
    public function ingresoUsuario(Request $request): Response 
    {
        // Si el formulario ha sido enviado
        if ($request->isMethod("POST"))
        {
            // Obttiene los datos del formulario
            $username = $request->request->get("user");
            $password = $request->request->get("pass");
            
            // Comprueba que el cliente exista dentro de la base de datos
            $clienteRepository = $this->entityManager->getRepository(Cliente::class);
            $cliente = $clienteRepository->findOneBy(['username' => $username, 'password' => $password ]);
    
            if ($cliente) {
                // Si las credenciales son correctas, redirige al cliente
                return $this->render('cliente/cliente.html.twig');
            } else {
                // Si las credenciales son incorrectas, muestra un mensaje de error
                $this->addFlash('fail', 'Usuario o contraseña incorrectos');
                return $this->render('registro/registro.html.twig'); // Redirige de nuevo al formulario de ingreso
            }
        }
    
        // Si el método no es POST, simplemente renderiza el formulario de ingreso
        return $this->render('registro/registro.html.twig');
    }

}
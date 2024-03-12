<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Entity\Categoria;
use App\Entity\Transaccion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistroController extends AbstractController
{

    private $entityManager;
    private $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }


    #[Route("/registro", name :"registro_u", methods: ["GET", "POST"])]
    public function registroUsuario(Request $request): Response
    {
        // Si el formulario ha sido enviado
        if ($request->isMethod('POST'))
        {
            // Obtiene los datos del formulario
            $nombre = $request->request->get('nombre');
            $apellido = $request->request->get('apellido');
            $mail = $request->request->get('mail');
            $dni = $request->request->get('dni');
            $user = $request->request->get('user');
            $password = $request->request->get('pass');

            // Verifica si todos los campos están completos
            if ($nombre && $apellido && $mail && $dni && $user && $password)
            {
                // Verifica si el nombre de usuario ya existe en la base de datos
                $existingCliente = $this->entityManager->getRepository(Cliente::class)->findOneBy(['username' => $user]);
                
                if ($existingCliente) 
                {
                    // Si el usuario ya existe, muestra un mensaje de error
                    $this->addFlash('existent', 'Usuario existente');
                    return $this->redirectToRoute('registro_u');
                }
                
                // Crear una nueva instancia de Cliente y establecer sus propiedades
                $cliente = new Cliente();
                $cliente->setNombre($nombre);
                $cliente->setApellido($apellido);
                $cliente->setEmail($mail);
                $cliente->setDni($dni);
                $cliente->setUsername($user);
                $cliente->setPassword($password);
                $cliente->setSaldo(50000);
                $cliente->setPassword($this->passwordHasher->hashPassword($cliente, $cliente->getPassword()));


                // Persistir los datos en la base de datos
                $this->entityManager->persist($cliente);
                $this->entityManager->flush();

                $this->addFlash('exito', 'Se ha registrado exitosamente');
                
                // Redirigir a alguna página de confirmación o a la página de inicio
                return $this->redirectToRoute('app_login');

            } else {
                // Si alguno de los campos está vacío, muestra un mensaje de error
                $this->addFlash('complete', 'Complete todos los campos');
                return $this->redirectToRoute('registro_u');
            }
        }
        // Si el método no es POST, simplemente renderiza el formulario de ingreso
        return $this->render('registro/registro.html.twig');
    }

}
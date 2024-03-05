<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Cliente;

class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'app_registro')]
    public function index(): Response
    {
        return $this->render('registro/registro.html.twig', [
            'controller_name' => 'RegistroController',
        ]);
    }

    public function Registro(){
        $entityManager = $this->getDoctrine()->getManager();
        
        $Cliente = new Cliente();

        //datos
        $Cliente -> setUsername('');
        $Cliente -> setPassword('');
        $Cliente -> setNombre('');
        $Cliente -> setApellido('');
        $Cliente ->setEmail('');
        $Cliente -> setDni('');

        //doctrine
        $entityManager->persist($Cliente);

        //base de datos
        $entityManager->flush();
    }
}

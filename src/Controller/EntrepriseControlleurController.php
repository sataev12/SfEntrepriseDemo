<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EntrepriseControlleurController extends AbstractController
{
    #[Route('/entreprise/controlleur', name: 'app_entreprise_controlleur')]
    public function index(): Response
    {
        $name = 'Elan Formation';
        return $this->render('entreprise_controlleur/index.html.twig', [
            'name' => $name
        ]);
    }
}

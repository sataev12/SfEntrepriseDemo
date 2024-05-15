<?php

namespace App\Controller;


use App\Entity\Entreprise;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntrepriseControlleurController extends AbstractController
{
    #[Route('/entreprise/controlleur', name: 'app_entreprise_controlleur')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $entreprises = $entityManager->getRepository(Entreprise::class)->findAll();
        return $this->render('entreprise_controlleur/index.html.twig', [
            'entreprises' => $entreprises
        ]);
    }
}

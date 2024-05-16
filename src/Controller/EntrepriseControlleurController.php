<?php

namespace App\Controller;


use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntrepriseControlleurController extends AbstractController
{
    #[Route('/entreprise/controlleur', name: 'app_entreprise_controlleur')]
    // public function index(EntityManagerInterface $entityManager): Response
    public function index(EntrepriseRepository $entrepriseRepository): Response
    {
        // $entreprises = $entityManager->getRepository(Entreprise::class)->findAll();
        $entreprises = $entrepriseRepository->findBy([], ["raisonSociale" => "ASC"]);
        return $this->render('entreprise_controlleur/index.html.twig', [
            'entreprises' => $entreprises
        ]);
    }

    
    #[Route('/entreprise/controlleur/new', name: 'new_entreprise_controlleur')]
    public function new(Request $request): Response
    {
        $entreprise = new Entreprise();
        
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        
        return $this->render('entreprise_controlleur/new.html.twig', [
            'formAddEntreprise' =>$form,
        ]);
    }

    #[Route('/entreprise/controlleur/{id}', name: 'show_entreprise_controlleur')]
    public function show( Entreprise $entreprise): Response
    {
        return $this->render('/entreprise_controlleur/show.html.twig', [
            'entreprise' => $entreprise
        ]);
    }
}

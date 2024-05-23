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
    #[Route('/entreprise/controlleur/{id}/edit', name: 'edit_entreprise_controlleur')]
    public function new_edit(Entreprise $entreprise = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$entreprise) {
            $entreprise = new Entreprise();
        }
        
        $form = $this->createForm(EntrepriseType::class, $entreprise);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entreprise = $form->getData();
            $entityManager->persist($entreprise);
            $entityManager->flush();

            return $this->redirectToRoute('app_entreprise_controlleur');
        }
        
        return $this->render('entreprise_controlleur/new.html.twig', [
            'formAddEntreprise' =>$form,
            'edit' => $entreprise->getId()
        ]);
    }

    #[Route('entreprise/controlleur/{id}/delete', name: 'delete_entreprise_controlleur')]
    public function delete(Entreprise $entreprise, EntityManagerInterface $entityManager){
        $entityManager->remove($entreprise);
        $entityManager->flush();

        return $this->redirectToRoute('app_entreprise_controlleur');
    }

    #[Route('/entreprise/controlleur/{id}', name: 'show_entreprise_controlleur')]
    public function show( Entreprise $entreprise): Response
    {
        return $this->render('/entreprise_controlleur/show.html.twig', [
            'entreprise' => $entreprise
        ]);
    }
}

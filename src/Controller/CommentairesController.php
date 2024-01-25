<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commentaires;
use App\Form\CommentairesType;
use Doctrine\ORM\EntityManagerInterface;

class CommentairesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commentaires", name="app_commentaires")
     */
    public function index(): Response
    {
        $commentaires = $this->entityManager->getRepository(Commentaires::class)->findAll();

        return $this->render('commentaires/index.html.twig', [
            'commentaires' => $commentaires,
        ]);
    }

    /**
     * @Route("/commentaires/new", name="commentaires_new")
     */
    public function new(Request $request): Response
    {
        $commentaire = new Commentaires();
        $form = $this->createForm(CommentairesType::class, $commentaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($commentaire);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_commentaires');
        }

        return $this->render('commentaires/new.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form->createView(),
        ]);
    }

}
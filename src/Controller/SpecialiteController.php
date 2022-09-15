<?php

namespace App\Controller;

use App\Entity\Specialite;
use App\Form\SpecialiteType;
use App\Repository\SpecialiteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/specialite')]
class SpecialiteController extends AbstractController
{

    #[Route('/', name: 'specialite.list')]
    public function index(ManagerRegistry $doctrine, SpecialiteRepository $repository, PaginatorInterface $paginator, Request $request): Response 
    
    {
        $specialites = $paginator->paginate(
        $specialites = $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $repository = $doctrine->getRepository(persistentObject: Specialite::class);
        return $this->render('specialite/index.html.twig', ['specialites' => $specialites,]);
    }


    
    #[Route('/{id<\d+>}', name: 'specialite.detail')]
    public function detail(Specialite $specialite = null): Response 
    
    {

        if(!$specialite) {
            $this->addFlash(type: 'error', message: "La specialite  n'existe pas");
            return $this->redirectToRoute('planque');
        }
        return $this->render('specialite/detail.html.twig', ['specialite' => $specialite]);
    }

    #[Route('/detail', name: 'app_specialite_detail', methods: ['GET'])]
    public function details(SpecialiteRepository $specialiteRepository, $id ): Response
    {


        return $this->render('specialite/detail.html.twig', [
            'specialites' => $specialiteRepository->findby($id),
        ]);
    }






   // #[Route('/', name: 'app_specialite_index', methods: ['GET'])]
   // public function index(SpecialiteRepository $specialiteRepository): Response
   // {
       // return $this->render('specialite/index.html.twig', [
           // 'specialites' => $specialiteRepository->findAll(),
       // ]);
   // }

   // #[Route('/new', name: 'app_specialite_new', methods: ['GET', 'POST'])]
   // public function new(Request $request, SpecialiteRepository $specialiteRepository): Response
   // {
      //  $specialite = new Specialite();
       // $form = $this->createForm(SpecialiteType::class, $specialite);
       // $form->handleRequest($request);

       // if ($form->isSubmitted() && $form->isValid()) {
          //  $specialiteRepository->add($specialite, true);

           // return $this->redirectToRoute('app_specialite_index', [], Response::HTTP_SEE_OTHER);
       // }

      //  return $this->renderForm('specialite/new.html.twig', [
           // 'specialite' => $specialite,
          //  'form' => $form,
        //]);
   // }

   // #[Route('/{id}', name: 'app_specialite_show', methods: ['GET'])]
   // public function show(Specialite $specialite): Response
   // {
      //  return $this->render('specialite/show.html.twig', [
           // 'specialite' => $specialite,
       // ]);
    //}

   // #[Route('/{id}/edit', name: 'app_specialite_edit', methods: ['GET', 'POST'])]
   // public function edit(Request $request, Specialite $specialite, SpecialiteRepository $specialiteRepository): Response
   // {
     //   $form = $this->createForm(SpecialiteType::class, $specialite);
       // $form->handleRequest($request);

      //  if ($form->isSubmitted() && $form->isValid()) {
          //  $specialiteRepository->add($specialite, true);

           // return $this->redirectToRoute('app_specialite_index', [], Response::HTTP_SEE_OTHER);
      //  }

       // return $this->renderForm('specialite/edit.html.twig', [
           // 'specialite' => $specialite,
          //  'form' => $form,
       // ]);
   // }

   // #[Route('/{id}', name: 'app_specialite_delete', methods: ['POST'])]
   // public function delete(Request $request, Specialite $specialite, SpecialiteRepository $specialiteRepository): Response
    //{
       // if ($this->isCsrfTokenValid('delete'.$specialite->getId(), $request->request->get('_token'))) {
          //  $specialiteRepository->remove($specialite, true);
       // }

       // return $this->redirectToRoute('app_specialite_index', [], Response::HTTP_SEE_OTHER);
   // }
}

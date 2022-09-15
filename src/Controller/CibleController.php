<?php

namespace App\Controller;

use App\Entity\Cible;
use App\Form\CibleType;
use App\Repository\CibleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cible')]
class CibleController extends AbstractController
{
    
    #[Route('/', name: 'cible.list')]
    public function index(ManagerRegistry $doctrine, CibleRepository $repository, PaginatorInterface $paginator, Request $request): Response 
    
    {
        $cibles = $paginator->paginate(
        $cibles = $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $repository = $doctrine->getRepository(persistentObject: Cible::class);
        return $this->render('cible/index.html.twig', ['cibles' => $cibles,]);
    }


    
    #[Route('/{id<\d+>}', name: 'cible.detail')]
    public function detail(Cible $cible = null): Response 
    
    {

        if(!$cible) {
            $this->addFlash(type: 'error', message: "Le cible  n'existe pas");
            return $this->redirectToRoute('cible');
        }
        return $this->render('cible/detail.html.twig', ['cible' => $cible]);
    }

    #[Route('/detail', name: 'app_cible_detail', methods: ['GET'])]
    public function details(CibleRepository $cibleRepository, $id ): Response
    {


        return $this->render('cible/detail.html.twig', [
            'cibles' => $cibleRepository->findby($id),
        ]);
    }
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   // #[Route('/', name: 'app_cible_index', methods: ['GET'])]
   // public function index(CibleRepository $cibleRepository): Response
   // {
        //return $this->render('cible/index.html.twig', [
           // 'cibles' => $cibleRepository->findAll(),
        //]);
   // }

   // #[Route('/new', name: 'app_cible_new', methods: ['GET', 'POST'])]
    //public function new(Request $request, CibleRepository $cibleRepository): Response
   // {
      //  $cible = new Cible();
       // $form = $this->createForm(CibleType::class, $cible);
       // $form->handleRequest($request);

       // if ($form->isSubmitted() && $form->isValid()) {
           // $cibleRepository->add($cible, true);

           // return $this->redirectToRoute('app_cible_index', [], Response::HTTP_SEE_OTHER);
        //}

       // return $this->renderForm('cible/new.html.twig', [
        //    'cible' => $cible,
         //   'form' => $form,
        //]);
   // }

   // #[Route('/{id}', name: 'app_cible_show', methods: ['GET'])]
   // public function show(Cible $cible): Response
   // {
       // r//  'cible' => $cible,
       // ]);
  // }

   // #[Route('/{id}/edit', name: 'app_cible_edit', methods: ['GET', 'POST'])]
    //public function edit(Request $request, Cible $cible, CibleRepository $cibleRepository): Response
    //{
       // $form = $this->createForm(CibleType::class, $cible);
       // $form->handleRequest($request);

        //if ($form->isSubmitted() && $form->isValid()) {
          // $cibleRepository->add($cible, true);

           // return $this->redirectToRoute('app_cible_index', [], Response::HTTP_SEE_OTHER);
       // }

      //  return $this->renderForm('cible/edit.html.twig', [
        //    'cible' => $cible,
          //  'form' => $form,
       // ]);
  //  }

    //#[Route('/{id}', name: 'app_cible_delete', methods: ['POST'])]
   // public function delete(Request $request, Cible $cible, CibleRepository $cibleRepository): Response
   // {
     //   if ($this->isCsrfTokenValid('delete'.$cible->getId(), $request->request->get('_token'))) {
      //      $cibleRepository->remove($cible, true);
        //}

      //  return $this->redirectToRoute('app_cible_index', [], Response::HTTP_SEE_OTHER);
  //  }
}

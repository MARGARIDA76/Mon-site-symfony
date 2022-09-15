<?php

namespace App\Controller;

use App\Entity\Planque;
use App\Form\PlanqueType;
use App\Repository\PlanqueRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/planque')]
class PlanqueController extends AbstractController
{

    #[Route('/', name: 'planque.list')]
    public function index(ManagerRegistry $doctrine, PlanqueRepository $repository, PaginatorInterface $paginator, Request $request): Response 
    
    {
        $planques = $paginator->paginate(
        $planques = $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $repository = $doctrine->getRepository(persistentObject: Planque::class);
        return $this->render('planque/index.html.twig', ['planques' => $planques,]);
    }


    
    #[Route('/{id<\d+>}', name: 'planque.detail')]
    public function detail(Planque $planque = null): Response 
    
    {

        if(!$planque) {
            $this->addFlash(type: 'error', message: "La planque  n'existe pas");
            return $this->redirectToRoute('planque');
        }
        return $this->render('planque/detail.html.twig', ['planque' => $planque]);
    }

    #[Route('/detail', name: 'app_planque_detail', methods: ['GET'])]
    public function details(PlanqueRepository $planqueRepository, $id ): Response
    {


        return $this->render('planque/detail.html.twig', [
            'planques' => $planqueRepository->findby($id),
        ]);
    }



    //#[Route('/', name: 'app_planque_index', methods: ['GET'])]
   // public function index(PlanqueRepository $planqueRepository): Response
   // {
       // return $this->render('planque/index.html.twig', [
            //'planques' => $planqueRepository->findAll(),
       // ]);
   // }

   // #[Route('/new', name: 'app_planque_new', methods: ['GET', 'POST'])]
    //public function new(Request $request, PlanqueRepository $planqueRepository): Response
    //{
       // $planque = new Planque();
        //$form = $this->createForm(PlanqueType::class, $planque);
        //$form->handleRequest($request);

       // if ($form->isSubmitted() && $form->isValid()) {
           // $planqueRepository->add($planque, true);

           // return $this->redirectToRoute('app_planque_index', [], Response::HTTP_SEE_OTHER);
       // }

       //return $this->renderForm('planque/new.html.twig', [
            //'planque' => $planque,
           // 'form' => $form,
       // ]);
    //}

    //#[Route('/{id}', name: 'app_planque_show', methods: ['GET'])]
   // public function show(Planque $planque): Response
    //{
      //  return $this->render('planque/show.html.twig', [
           // 'planque' => $planque,
       // ]);
   // }

   // #[Route('/{id}/edit', name: 'app_planque_edit', methods: ['GET', 'POST'])]
   // public function edit(Request $request, Planque $planque, PlanqueRepository $planqueRepository): Response
    //{
       // $form = $this->createForm(PlanqueType::class, $planque);
       // $form->handleRequest($request);

       // if ($form->isSubmitted() && $form->isValid()) {
          //  $planqueRepository->add($planque, true);

          //  return $this->redirectToRoute('app_planque_index', [], Response::HTTP_SEE_OTHER);
       // }

       // return $this->renderForm('planque/edit.html.twig', [
          //  'planque' => $planque,
           // 'form' => $form,
       // ]);
   // }

   // #[Route('/{id}', name: 'app_planque_delete', methods: ['POST'])]
    //public function delete(Request $request, Planque $planque, PlanqueRepository $planqueRepository): Response
   // {
      //  if ($this->isCsrfTokenValid('delete'.$planque->getId(), $request->request->get('_token'))) {
         //   $planqueRepository->remove($planque, true);
       // }

       // return $this->redirectToRoute('app_planque_index', [], Response::HTTP_SEE_OTHER);
   // }
}

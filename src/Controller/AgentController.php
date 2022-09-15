<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\AgentType;
use App\Repository\AgentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/agent')]
class AgentController extends AbstractController
{


    #[Route('/', name: 'agent.list')]
    public function index(ManagerRegistry $doctrine, AgentRepository $repository, PaginatorInterface $paginator, Request $request): Response 
    
    {
        $agents = $paginator->paginate(
        $agents = $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $repository = $doctrine->getRepository(persistentObject: Agent::class);
        return $this->render('agent/index.html.twig', ['agents' => $agents,]);
    }


    
    #[Route('/{id<\d+>}', name: 'agent.detail')]
    public function detail(Agent $agent = null): Response 
    
    {

        if(!$agent) {
            $this->addFlash(type: 'error', message: "L'agent  n'existe pas");
            return $this->redirectToRoute('agent');
        }
        return $this->render('agent/detail.html.twig', ['agent' => $agent]);
    }

    #[Route('/detail', name: 'app_agent_detail', methods: ['GET'])]
    public function details(AgentRepository $agentRepository, $id ): Response
    {


        return $this->render('agent/detail.html.twig', [
            'agents' => $agentRepository->findby($id),
        ]);
    }
   
   
   
   
   





    //#[Route('/', name: 'app_agent_index', methods: ['GET'])]
   // public function index(AgentRepository $agentRepository): Response
  //  {
      //  return $this->render('agent/index.html.twig', [
         //   'agents' => $agentRepository->findAll(),
       // ]);
  //  }

   // #[Route('/new', name: 'app_agent_new', methods: ['GET', 'POST'])]
   // public function new(Request $request, AgentRepository $agentRepository): Response
   // {
     //   $agent = new Agent();
       // $form = $this->createForm(AgentType::class, $agent);
       // $form->handleRequest($request);

      //  if ($form->isSubmitted() && $form->isValid()) {
         //   $agentRepository->add($agent, true);

         //   return $this->redirectToRoute('app_agent_index', [], Response::HTTP_SEE_OTHER);
       // }

       // return $this->renderForm('agent/new.html.twig', [
         //   'agent' => $agent,
          //  'form' => $form,
       // ]);
   // }

    //#[Route('/{id}', name: 'app_agent_show', methods: ['GET'])]
   // public function show(Agent $agent): Response
    //{
       // return $this->render('agent/show.html.twig', [
      //      'agent' => $agent,
      //  ]);
  //  }

   // #[Route('/{id}/edit', name: 'app_agent_edit', methods: ['GET', 'POST'])]
   // public function edit(Request $request, Agent $agent, AgentRepository $agentRepository): Response
  //  {
    //    $form = $this->createForm(AgentType::class, $agent);
      //  $form->handleRequest($request);

      //  if ($form->isSubmitted() && $form->isValid()) {
         //   $agentRepository->add($agent, true);

          //  return $this->redirectToRoute('app_agent_index', [], Response::HTTP_SEE_OTHER);
      //  }

      // return $this->renderForm('agent/edit.html.twig', [
       //    'agent' => $agent,
        //    'form' => $form,
       // ]);
  //  }

  //  #[Route('/{id}', name: 'app_agent_delete', methods: ['POST'])]
   // public function delete(Request $request, Agent $agent, AgentRepository $agentRepository): Response
   // {
      //  if ($this->isCsrfTokenValid('delete'.$agent->getId(), $request->request->get('_token'))) {
       //     $agentRepository->remove($agent, true);
        //}

       // return $this->redirectToRoute('app_agent_index', [], Response::HTTP_SEE_OTHER);
   // }
}

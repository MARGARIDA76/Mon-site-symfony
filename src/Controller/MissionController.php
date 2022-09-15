<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Repository\MissionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/mission')]
class MissionController extends AbstractController
{  
    
    #[Route('/', name: 'mission.list')]
    public function index(ManagerRegistry $doctrine, MissionRepository $repository, PaginatorInterface $paginator, Request $request): Response 
    
    {
        $missions = $paginator->paginate(
            $missions = $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $repository = $doctrine->getRepository(persistentObject: Mission::class);
        return $this->render('mission/index.html.twig', ['missions' => $missions,]);
    }


    
    #[Route('/{id<\d+>}', name: 'mission.detail')]
    public function detail(Mission $mission = null): Response 
    
    {

        if(!$mission) {
            $this->addFlash(type: 'error', message: "La mission  n'existe pas");
            return $this->redirectToRoute('mission');
        }
        return $this->render('mission/detail.html.twig', ['mission' => $mission]);
    }

    #[Route('/detail', name: 'app_mission_detail', methods: ['GET'])]
    public function details(MissionRepository $missionRepository, $id ): Response
    {


        return $this->render('mission/detail.html.twig', [
            'missions' => $missionRepository->findby($id),
        ]);
    }
   
}

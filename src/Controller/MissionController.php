<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Repository\MissionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/mission')]
class MissionController extends AbstractController
{

    #[Route('/', name: 'mission.list')]
    public function index(ManagerRegistry $doctrine): Response 
    
    {

        $repository = $doctrine->getRepository(persistentObject: Mission::class);
        $missions = $repository->findAll();
        return $this->render('mission/index.html.twig', ['missions' => $missions, 'isPaginated => true']);
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
    public function details(MissionRepository $missionRepository, $id): Response
    {
        return $this->render('mission/detail.html.twig', [
            'missions' => $missionRepository->findby($id),
        ]);
    }
   
}

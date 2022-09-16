<?php

namespace App\Controller\Admin;

use App\Entity\Agent;
use App\Entity\Cible;
use App\Entity\Contact;
use App\Entity\Mission;
use App\Entity\Planque;
use App\Entity\Specialite;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;


class DashboardController extends AbstractDashboardController
{       
        #[Route('/admin', name: 'admin')]
        public function index(): Response
        {
            return $this->render('admin/dashboard.html.twig');
        }
    

        public function configureDashboard(): Dashboard
        {
            return Dashboard::new()
                ->setTitle('GESTION-CONTENU');
        }
        
        public function configureMenuItems(): iterable
        {
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
            yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', Utilisateur::class);
            yield MenuItem::linkToCrud('Agent', 'fas fa-dumbbell', Agent::class);
            yield MenuItem::linkToCrud('Cible', 'fas fa-icicles', Cible::class);
            yield MenuItem::linkToCrud('Contact', 'fas fa-id-badge', Contact::class);
            yield MenuItem::linkToCrud('Mission', 'fas fa-dumbbell', Mission::class);
            yield MenuItem::linkToCrud('Planque', 'fas fa-hot-tub', Planque::class);
            yield MenuItem::linkToCrud('Specialite', 'fas fa-hot-tub', Specialite::class);
            
        }
}

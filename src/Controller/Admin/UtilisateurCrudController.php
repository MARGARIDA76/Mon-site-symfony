<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;



class UtilisateurCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }
    public  function configureActions(Actions $actions): Actions
    {
        return $actions

       ->add(Crud::PAGE_INDEX, Action::DETAIL)

       ->update(Crud::PAGE_INDEX, Action::NEW, function(Action $action){
        return $action->setIcon('fa fa-user')->addCssClass('btn btn-success');
    })
       ->update(Crud::PAGE_INDEX,Action::NEW,function(Action $action){
            return $action->setIcon('fa fa-edit')->addCssClass('btn btn-warning');
        })
       ->update(Crud::PAGE_INDEX,Action::DETAIL,function(Action $action){
           return $action->setIcon('fa fa-eye')->addCssClass('btn btn-info');
        }) 
       ->update(Crud::PAGE_INDEX,Action::DELETE,function(Action $action){
            return $action->setIcon('fa fa-trash')->addCssClass('btn btn-dangeroutline-dangeroutline');
         });            
    }



    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            EmailField::new('email')->hideOnForm(),
            TextField::new('password'),
            ArrayField::new('roles') ->hideOnIndex(),


        ];
    }


    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        ->add('name');
           
    }


    public function configureMenuItems(): iterable

    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Utulisateur',);
        yield MenuItem::subMenu('Utilisateur', 'fa fa-user')->setSubItems([
              MenuItem::linkToCrud('Create utilisateur','fas fa-plus', Utilisateur::class),
              MenuItem::linkToCrud('Show utilisateur','fas fa-eye', Utilisateur::class)
   
   
   ]);

         
        
        yield MenuItem::section('Societe');
        yield MenuItem::section('Missions',);
        yield MenuItem::subMenu('Mission', "fa-solid fa-hand-middle-finger")->setSubItems([
              MenuItem::linkToCrud('Create mission','fas fa-plus', Missions::class)->setAction(Crud::PAGE_NEW),
              MenuItem::linkToCrud('Show mission','fas fa-eye', Missions::class)


    ]);


       yield MenuItem::section('Agents',);
       yield MenuItem::subMenu('Agent', 'fas fa-dumbbell')->setSubItems([
             MenuItem::linkToCrud('Create agent','fas fa-plus', Agents::class)->setAction(Crud::PAGE_NEW),
             MenuItem::linkToCrud('Show agent','fas fa-eye', Agents::class)


   ]);


      yield MenuItem::section('Contacts',);
      yield MenuItem::subMenu('Contact', "fas fa-id-badge")->setSubItems([
            MenuItem::linkToCrud('Create contact','fas fa-plus', Contacts::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show contact','fas fa-eye', Contacts::class)


   ]);

      yield MenuItem::section('Cibles',);
      yield MenuItem::subMenu('Cible', "fas fa-icicles")->setSubItems([
            MenuItem::linkToCrud('Create cible','fas fa-plus', Cibles::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show cible','fas fa-eye', Cibles::class)


   ]);


      yield MenuItem::section('Planques',);
      yield MenuItem::subMenu('Planque', 'fas fa-hot-tub')->setSubItems([
            MenuItem::linkToCrud('Create planque','fas fa-plus', Planques::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show planque','fas fa-eye', Planques::class)


   ]);

    
     yield MenuItem::section('Specialites',);
     yield MenuItem::subMenu('Specialite', 'fas fa-spa')->setSubItems([
           MenuItem::linkToCrud('Create specialite', "fas fa-hot-tub", Specialites::class),
           MenuItem::linkToCrud('Show specialite','fas fa-eye', Specialites::class)


   ]);

    }    
}

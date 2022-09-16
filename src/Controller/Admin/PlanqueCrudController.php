<?php

namespace App\Controller\Admin;

use App\Entity\Planque;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PlanqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Planque::class;

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
                IdField::new('code_planque'),
                TextField::new('adresse'),
                TextField::new('type_planque'),
            ];
        }
    
          
        public function configureFilters(Filters $filters): Filters
        {
            return $filters
            ->add('code_planque');      
        }
}

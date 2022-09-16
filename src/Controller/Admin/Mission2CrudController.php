<?php

namespace App\Controller\Admin;

use App\Entity\Mission;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class Mission2CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mission::class;

    }

    public  function configureActions(Actions $actions): Actions

    {
       return $actions
       
       ->add(Crud::PAGE_INDEX, Action::DETAIL)
       
       ->update(Crud::PAGE_INDEX, Action::NEW, function(Action $action){
               return $action->setIcon('fa-solid fa-hand-middle-finger')->addCssClass('btn btn-success');
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
           TextField::new('titre_mission'),
           TextEditorField::new('description_mission'),
           TextField::new('nom_code'),
           TextField::new('pays'),
           TextField::new('type_mission'),
           TextField::new('statut_mission'),
           DateTimeField::new('date_debut'),
           DateTimeField::new('date_fin'),
           
       ];
   }

     
   public function configureFilters(Filters $filters): Filters
   {
       return $filters
       ->add('type_mission');      
   }

}

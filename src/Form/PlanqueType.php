<?php

namespace App\Form;

use App\Entity\Planque;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code_planque')
            ->add('adresse')
            ->add('pays')
            ->add('type_planque')
            ->add('Mission')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planque::class,
        ]);
    }
}

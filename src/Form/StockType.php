<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Pole; 
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class StockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomArticle')
            ->add('quantiteArticle')
            ->add('prixArticle')
            ->add('idPole', EntityType::class, [
                'class' => Pole::class,
                'label' => 'nomPole',
                'choice_label' => 'nomPole',
            ])
            ->add('imageFile', VichImageType::class)
            
            ->add('ajouter',SubmitType::class)
      
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

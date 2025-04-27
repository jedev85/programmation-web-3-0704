<?php

namespace App\Form;

use App\Entity\Enum\Speciality;
use App\Entity\Soigneur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoigneurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('speciality', EnumType::class, ['class' => Speciality::class, 'label'  => 'Spécialité', 'attr' => ['class' => 'form-control']])
            ->add('enregistrer', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-2']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Soigneur::class,
        ]);
    }
}

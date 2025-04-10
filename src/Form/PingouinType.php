<?php

namespace App\Form;

use App\Entity\Enclos;
use App\Entity\Pingouin;
use App\Entity\Soigneur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PingouinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('couleur')
            ->add('age')
            ->add('prenom')
            ->add('enclos', EntityType::class, ['class' => Enclos::class])
            ->add('soigneur', EntityType::class, ['class' => Soigneur::class])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pingouin::class,
        ]);
    }
}

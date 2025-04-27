<?php

namespace App\Form;

use App\Entity\Enclos;
use App\Entity\Enum\Color;
use App\Entity\Pingouin;
use App\Entity\Soigneur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PingouinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('color', EnumType::class, ['class' => Color::class, 'label' => 'Couleur', 'attr' => ['class' => 'form-control']])
            ->add('age', IntegerType::class, ['label' => "Âge", 'attr' => ['class' => 'form-control']])
            ->add('prenom', TextType::class, ['label' => "Prénom", 'attr' => ['class' => 'form-control']])
            ->add('enclos', EntityType::class, ['class' => Enclos::class, 'label' => "Enclos", 'attr' => ['class' => 'form-control']])
            ->add('soigneur', EntityType::class, ['class' => Soigneur::class, 'label' => "Soigneur", 'attr' => ['class' => 'form-control']])
            ->add('enregistrer', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-2']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pingouin::class,
        ]);
    }
}

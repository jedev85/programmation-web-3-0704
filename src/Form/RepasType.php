<?php

namespace App\Form;

use App\Entity\Enum\Type;
use App\Entity\Pingouin;
use App\Entity\Repas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RepasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite', IntegerType::class, ['label' => "Quantité", 'attr' => ['class' => 'form-control']])
            ->add('type', EnumType::class, ['class' => Type::class, 'label' => "Type", 'attr' => ['class' => 'form-control']])
            ->add(
                'is_eat',
                CheckboxType::class,
                [
                    'attr' => ['class' => 'form-check-input'],
                    'row_attr' => ['class' => 'form-check form-switch mt-3 mb-3'],
                    'required' => false,
                ]
            );
        if (!$options['data']->getPingouin()) {
            $builder->add('pingouin', EntityType::class, [
                'class' => Pingouin::class,
                'attr' => ['class' => 'form-control'],
            ]);
        }
        $builder->add('enregistrer', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-2']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Repas::class,
        ]);
    }
}

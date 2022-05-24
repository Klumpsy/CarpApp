<?php

namespace App\Form;

use App\Entity\Land;
use App\Entity\Soort;
use App\Entity\Vangst;
use App\Entity\Visser;
use App\Entity\Water;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class VangstenToevoegenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('water', EntityType::class, [
                'label' => 'Naam van het water',
                'class' => Water::class
            ])
            ->add('visser', EntityType::class, [
                'label' => 'Gevangen door',
                'class' => Visser::class
            ])
            ->add('gewicht', NumberType::class, [
                'label' => 'Gewicht in ponden'
            ])
            ->add('soort', EntityType::class, [
                'class' => Soort::class,
                'label' => 'Soort'
            ])
            ->add('diepte', NumberType::class, [
                'label' => 'Diepte waarop gevangen (in cm)',
                'required' => false
            ])
            ->add('rig')
            ->add('foto', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10M',
                        'maxSizeMessage' => 'Te groot bestand, maximale grootte: ({{ limit }} {{ suffix }})'
                    ])
                ]
            ])
            ->add('land', EntityType::class, [
                'class' => Land::class,
                'label' => 'Land van vangst'
            ])
            ->add('datum', DateType::class)
            ->add('tijd', TimeType::class)
            ->add('aantekeningen', TextareaType::class, [
                'required' => false,
            ])
            ->add('graden', HiddenType::class, [
                'attr' => [
                    'mapped' => false,
                    'id' => 'weather-data-graden',
                    'value' => ''
                ]
            ])
            ->add('windrichting', HiddenType::class, [
                'attr' => [
                    'mapped' => false,
                    'id' => 'weather-data-windrichting',
                    'value' => ''
                ]
            ])
            ->add('windsnelheid', HiddenType::class, [
                'attr' => [
                    'mapped' => false,
                    'id' => 'weather-data-windsnelheid',
                    'value' => ''
                ]
            ])
            ->add('luchtdruk', HiddenType::class, [
                'attr' => [
                    'mapped' => false,
                    'id' => 'weather-data-luchtdruk',
                    'value' => ''
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Opslaan',
                'attr' => [
                    'class' => 'button mainGreenBackground expanded'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vangst::class,
            'allow_extra_fields' => true,
            'csrf_protection' => false,
        ]);
    }
}

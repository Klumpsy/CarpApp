<?php

namespace App\Form;

use App\Entity\Land;
use App\Entity\Water;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class WaterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true
            ])
            ->add('land', EntityType::class, [
                'class' => Land::class
            ])
            ->add('nachtvissen')
            ->add('boot')
            ->add('voerboot')
            ->add('bereikbaarheid', TextareaType::class, [
                'required' => false,
            ])
            ->add('oppervlakte', TextareaType::class, [
                'label' => 'Oppervlakte in (Ha)',
                'required' => true
            ])

            ->add ('kreeften')
            ->add ('moeilijk', CheckboxType::class, [
                'label' => "Moeilijk water",
                'required' => false,
            ])
            ->add ('smallFish', CheckboxType::class, [
                'label' => "Veel kleine vis",
                'required' => false,
            ])
            ->add('bigFish', CheckboxType::class, [
                'label'=>'Grote vis',
                'required' => false,
            ])
            ->add('hotspots', TextareaType::class, [
                'required' => false,
            ])
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
            ->add('aantekeningen', TextareaType::class, [
                'required' => false
            ])

            ->add('ongewenst')

            ->add('Opslaan', SubmitType::class, [
                'attr' => [
                    'class' => "button mainGreenBackground expanded"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Water::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Land;
use App\Entity\Water;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class WaterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('land', EntityType::class, [
                'class' => Land::class
            ])
            ->add('type')
            ->add('nachtvissen')
            ->add('boot')
            ->add('voerboot')
            ->add('bereikbaarheid')
            ->add('oppervlakte')
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

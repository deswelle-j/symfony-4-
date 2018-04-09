<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class AddEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Nom de l\'évenement:', 'attr' => array('placeholder' =>'Nom',)))
            ->add('startAt', DateTimeType::class, array('label' => 'Début de l\'évenement :', 'widget' => 'single_text',))
            ->add('shouldEndAt', DateTimeType::class, array('label' => 'Fin de l\'évenement :', 'widget' => 'single_text',))
            ->add('description', TextareaType::class, array('label' => 'description de l\'évènement:'))
            ->add('options', null, array('choice_label' => 'name', 'expanded' => true))
            ->add('place', null, array('choice_label' => 'name', 'expanded' => true))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}

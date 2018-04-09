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
            ->add('name', TextType::class, array('label' => 'name'))
            ->add('startAt', DateTimeType::class, array('label' => 'startAt'))
            ->add('shouldEndAt', DateTimeType::class, array('label' => 'shouldEndAt'))
            ->add('description', TextareaType::class, array('label' => 'description'))
            ->add('options', null, array('choice_label' => 'options'))
            ->add('place', null, array('choice_label' => 'place'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}

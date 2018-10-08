<?php

namespace AppBundle\Form;

use AppBundle\Entity\Promotion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shop', EntityType::class, array(
                'class' => 'AppBundle\Entity\Shop',
                'choice_label' => 'displayName',
                'multiple' => false,
                'required' => true,
                'placeholder' => '--'
            ))
            ->add('type', ChoiceType::class, array(
                'multiple' => false,
                'expanded' => true,
                'choices' => Promotion::TYPE_PROMOTION
            ))
            ->add('expirationDate', DateType::class)
            ->add('promotion', TextType::class, array(
                'required' => true
            ))
            ->add('description', TextareaType::class, array(
                'required' => false
            ))
            ->add('redirectUrl')
            ->add('sponsor', SponsorType::class)
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Promotion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_promotion';
    }


}

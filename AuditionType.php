<?php

namespace AuditionBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuditionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
                ->add('photo')
                ->add('date')
                ->add('description')
                ->add('video')
                ->add('checked')
                ->add('qualified')
                ->add('categorie',EntityType::class,array('class'=>'AuditionBundle:Categorie','choice_label'=>'nom','multiple'=>false))
                ->add('user')
                ->add("Submit",SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AuditionBundle\Entity\Audition'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'auditionbundle_audition';
    }


}

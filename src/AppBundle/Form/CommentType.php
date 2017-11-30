<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('content', TextareaType::class, array(
            "label" => "Message",
            'attr' => array(
                "class" => "materialize-textarea",
                'min_length' => 3,
                'max_length' => 255
            )))
            ->add('color',ChoiceType::class,
                array('choices' => array(
                    'Blue' => 'blue lighten-4',
                    'Red' => 'red lighten-4',
                    'Green' => 'green lighten-4',
                    'White' => 'grey lighten-4',
                    'Purple' => 'deep-purple lighten-4'
                    ),
                    'choices_as_values' => true,
                    'multiple'=>false,
                    'expanded'=>true,
                ))
            ->add('send', SubmitType::class, array(
                'attr' => array('class'=>"btn waves-effect waves-light light-green")
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Comment'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_comment';
    }


}

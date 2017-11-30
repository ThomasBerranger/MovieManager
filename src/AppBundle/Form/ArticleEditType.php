<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Thomas\TagBundle\Form\Type\TagsType;

class ArticleEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('author', TextType::class)
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'format' => 'd-M-y',
                'attr' => array("class"=>"datepicker", "placeholder"=>"dd/mm/yyyy"),
            ])
            ->add('synopsis', TextareaType::class, array(
                "attr" => array(
                    "class" => "materialize-textarea"
                )
            ))
            ->add('category', EntityType::class, array(
                'class'=>'AppBundle\Entity\Category',
                'choice_label'=>'name',
                'expanded'=>false,
                'multiple'=>false,
                'attr' => array('class' => 'select-dropdown')
            ))
            ->add('tags', TagsType::class)
            ->add('note', RangeType::class, array(
                'attr' => array('class' => 'range-field', 'min'=>"0", 'max'=>"10")
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Edit',
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
            'data_class' => 'AppBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_article';
    }

}

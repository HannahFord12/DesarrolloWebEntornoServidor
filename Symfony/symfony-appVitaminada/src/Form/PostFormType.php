<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',  null, ['attr' => ['class'=>'form-control']])
            ->add('content',  null, ['attr' => ['class'=>'form-control']])
            ->add('image',FileType::class,[
                'mapped' => false,
                'constraints' => [
                    new File([
                        'mimeTypes'=>[
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file'
                    ])
                ]
            ])
            ->add('category', EntityType::class,array(
                'class' => Category::class,
                'choice_label' => 'name'
            ))
            ->add('send', SubmitType::class, array('label' => 'Send', 'attr' => ['class'=>'btn btn-lg']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}

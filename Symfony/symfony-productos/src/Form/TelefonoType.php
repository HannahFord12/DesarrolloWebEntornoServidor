<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Provincia;

class TelefonoType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marca', TextType::class)
            ->add('modelo', TextType::class)
            ->add('precio', IntegerType::class)
            ->add('procesador', TextType::class)
            ->add('ram', TextType::class)
            ->add('Almacenamiento', TextType::class)
            /* ->add('tienda', EntityType::class, array(
                'class' => Provincia::class,
                'choice_label' => 'nombre',)) */
            ->add('save', SubmitType::class, array('label' => 'Enviar'));
    }
}
<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null,['attr' =>['id' => 'name']])
            ->add('email', null,['attr' =>['id' => 'email']])
            ->add('text', null,['attr' =>['id' => 'message']])
            ->add('Send', SubmitType::class, array('label' => 'Send','attr' => ['id'=>'form-submit', 'class'=>'main-button']));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}

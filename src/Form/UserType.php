<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',null, [
                'label' => 'Nome',
            ])
            ->add('password',PasswordType::class, [
                'label' => 'Senha',
            ])
            ->add('birth_date', null, [
                'widget' => 'single_text',
            ])
            ->add('postcode',null,[
                'label' => 'CEP',
            ])
            ->add('status',ChoiceType::class, [
                'label' => 'Status',
                'choices' => [
                    'Ativo' => User::STATUS_ATIVO,
                    'Desativado' => User::STATUS_DESATIVADO,
                ]  
            ])
            ->add('code_erp')
            ->add('photo')
            ->add('hire_date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('email')
           
            ->add('role', EntityType::class, [
                'class' => Role::class,
                'label' => 'Função',
                'choice_label' => 'description',
                'choice_value' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

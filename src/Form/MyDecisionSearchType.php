<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyDecisionSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('search', ChoiceType::class, [
                'required' => true,
                'label' => false,
                'choices' => [
                        'Choisissez le statut' => '',
                        'Avis en cours' => 'Deadline pour donner son avis',
                        'Prendre sa première décision' => 'Première décision prise',
                        'Conflits en cours' => 'Deadline pour entrer en conflit',
                        'Prendre sa décision définitive' =>  'Décision définitive',
                        'Décision terminée' => 'Décision terminée',
                    ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            //'data_class' => Decision::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }
}

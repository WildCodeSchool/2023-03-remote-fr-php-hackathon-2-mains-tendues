<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Location;
use App\Entity\Model;
use App\Entity\Ram;
use App\Entity\Smartphone;
use App\Entity\Status;
use App\Entity\Stockage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SmartphoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('brand', EntityType::class, [
                "class" => Brand::class,
                "choice_label" => 'name'
            ])
            ->add('model', EntityType::class, [
                "class" => Model::class,
                "choice_label" => 'name'
            ])
            ->add('ram', EntityType::class, [
                "class" => Ram::class,
                "choice_label" => "ram"
            ])
            ->add('stockage', EntityType::class, [
                "class" => Stockage::class,
                "choice_label" => "size"
                ])
            ->add('status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'status'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Smartphone::class,
        ]);
    }
}

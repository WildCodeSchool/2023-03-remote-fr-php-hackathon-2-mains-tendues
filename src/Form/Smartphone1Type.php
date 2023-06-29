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

class Smartphone1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', EntityType::class, [
                "class" => Brand::class,
                "choice_label" => 'name',
                "label" => "Marque",
            ])
            ->add('model', EntityType::class, [
                "class" => Model::class,
                "choice_label" => 'name',
                "label" => "Modèle",
                "group_by" => function (Model $model) {
                    return $model->getBrand()->getName();
                },
            ])
            ->add('price')
            ->add('ram', EntityType::class, [
                "class" => Ram::class,
                "choice_label" => "ram",
                "label" => "Mémoire vive (Go)",
            ])
            ->add('stockage', EntityType::class, [
                "class" => Stockage::class,
                "choice_label" => "size",
                "label" => "Stockage (Go)",
            ])
            ->add('status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'status',
                "label" => "Etat du téléphone",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Smartphone::class,
        ]);
    }
}

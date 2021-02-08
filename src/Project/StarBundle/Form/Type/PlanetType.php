<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class PlanetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, array('mapped' => false))
            ->add('mass', IntegerType::class, array('mapped' => false))
            ->add('distance', IntegerType::class, array('mapped' => false))
            ->add('save', SubmitType::class);
    }
}

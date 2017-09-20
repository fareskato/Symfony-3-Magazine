<?php

namespace Ecommerce\CatalogBundle\Form;

use Ecommerce\CatalogBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')->add('urlKey')->add('price', MoneyType::class, array(
            'divisor' => 100,
        ))->add('sku')->add('description')->add('qty')->add('category', EntityType::class, [
            'class' => Category::class,
            'placeholder' => 'Select category'
        ])->add('image')->add('onsale');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ecommerce\CatalogBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ecommerce_catalogbundle_product';
    }


}

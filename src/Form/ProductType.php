<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use App\Form\PictureType;
use App\Form\InventoryType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('description', TextareaType::class)

            ->add('picture', UrlType::class, [
                'label' => 'Photo',

            ])
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    'Woman' => 'Woman',
                    'Man' => 'Man',
                    'Unisex' => 'Unisex'
                ],
                // Boutons radios
                'expanded' => true, 
                'label_attr' => [
                    'class' => 'radio-inline',
                ],         
                'label' => 'Genre'     
            ])
            ->add('color', ChoiceType::class, [
                'label' => 'Couleur',
                'choices'  => [
                    'Bleu Clair' => 'Bleu Clair',
                    'Noir' => 'Noir',
                    'Bleu' => 'Bleu',
                    'Jaune' => 'Jaune',
                    'Rouge' => 'Rouge',
                    'Gris' => 'Gris',
                    'Vert' => 'Vert',
                    'Kaki' => 'Kaki'
                ],
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix'
            ])
            //->add('best_sellers_order')
            //->add('createdAt')
            //->add('updatedAt')
            ->add('category', EntityType::class, [
                'label' => 'Catégorie',
                // @link https://symfony.com/doc/current/reference/forms/types/entity.html#basic-usage
                'class' => Category::class,
                // Requête custom pour trier les genres par ordre alpha
                // https://symfony.com/doc/current/reference/forms/types/entity.html#using-a-custom-query-for-the-entities
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',
                //'multiple' => true,
                //'expanded' => true,
            ])
            ->add('inventories', CollectionType::class, [
                'entry_type' => InventoryType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'Inventaire'
            ])      
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

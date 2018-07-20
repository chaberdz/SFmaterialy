<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use AppBundle\Entity\Jednostka;
use AppBundle\Entity\Grupa;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MaterialType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

      $material = $builder->getData();


      $builder->add('kod', TextType::class, ['label' => 'Kod Materiału'])
              ->add('nazwa', TextType::class, ['label' => 'Nazwa materiału'])
              ->add('jednostka', EntityType::class,
                              ['class' => Jednostka::class,
                               'choice_label' => 'nazwa'] )
              ->add('grupa', EntityType::class,
                              ['class' => Grupa::class,
                               'choice_label' => 'nazwa'] )
                ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Material'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_material';
    }



}

<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use AppBundle\Entity\Grupa;

use AppBundle\Repository\GrupaRepository;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GrupaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


      $em = $options['em'];
      $grupa = $em->getRepository('AppBundle:Grupa');

      $builder->add('nazwa', TextType::class, ['label' => 'Nazwa'])
               ->add('parentId', ChoiceType::class, ['data' => 0,
                                                     'label' => 'Grupa nadrzędna',
                                                     'choices' => $grupa->getListForChoiceField()
                                                    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Grupa'
                    ))
                  ->setRequired(['em'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_grupa';
    }


}

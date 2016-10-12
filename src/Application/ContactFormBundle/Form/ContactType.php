<?php

namespace Application\ContactFormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, array('label' => false, 'attr' => array('placeholder' => 'First Name')))
            ->add('lastName', null, array('label' => false, 'attr' => array('placeholder' => 'Last Name')))
            ->add('email', null, array('label' => false, 'attr' => array('placeholder' => 'Email')))
            ->add('message', null, array('label' => false, 'attr' => array('placeholder' => 'Message')))
            ->add('save', 'submit', array('label' => 'Submit'))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\ContactFormBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'application_contactformbundle_contact';
    }
}

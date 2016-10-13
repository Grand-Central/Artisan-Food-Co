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
            ->add('name', null, array('attr' => array('placeholder' => 'First name, last name')))
            ->add('email', null, array('attr' => array('placeholder' => 'name@provider.com')))
            ->add('message', null, array('label' => 'Comments', 'attr' => array('placeholder' => 'I\'d love to know your thoughts')))
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

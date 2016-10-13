<?php

namespace Application\ContactFormBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ContactAdmin extends Admin
{
    protected $classnameLabel = 'Contact Form Submissions';

    public function getBaseRouteName() {
        return 'applicaiton_contact_form_submissions';
    }

    public function getBaseRoutePattern() {
        return '/contact-form-submissions';
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(array('list', 'show', 'export'));
    }

    public function getExportFormats()
    {
        return array(
            'csv', 'xls'
        );
    }

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC', // sort direction
        '_sort_by' => 'created' // field name
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('email')
            ->add('message')
            // ->add('created', 'doctrine_orm_date_range', array('label' => 'Submitted Between'), '', array(
            //         'label' => false,
            //         'widget' => 'single_text',
            //         'format' => 'dd/MM/yyyy',
            //         'attr' => array('class' => 'date')
            //     ))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('email')
            ->add('message')
            ->add('created', null, array('label' => 'Submitted'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                )
            ))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('email')
            ->add('message')
            ->add('created', null, array('label' => 'Submitted'))
        ;
    }
}

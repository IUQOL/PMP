<?php

namespace XYK\PMP\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProccessGroupAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper

            ->addIdentifier('name')
            ->add('description')
            ->add('percentage')
           
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                   
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
  
            ->add('name')
            ->add('description')
            ->add('percentage')
     
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
       
            ->add('name')
            ->add('description')
            ->add('percentage')

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function prePersist($proccessGroup) {
        $now = new \DateTime();
        $proccessGroup->setCurrent($now);
        parent::prePersist($proccessGroup);
    }
    
    /**
     * {@inheritdoc}
     */
    public function preUpdate($proccessGroup) {
        $now = new \DateTime();
        $proccessGroup->setCurrent($now);
        parent::preUpdate($proccessGroup);
    }
}

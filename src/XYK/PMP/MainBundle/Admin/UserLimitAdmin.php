<?php

namespace XYK\PMP\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserLimitAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user')
            ->add('examType')
            
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('user')
            ->add('examType')    
            ->addIdentifier('allowed')
            ->add('used')
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
            ->add('user')
            ->add('examType')
            ->add('allowed')
            ->add('used')
           
            
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('user')
            ->add('examType')
            ->add('allowed')
            ->add('used')
           
            
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function prePersist($userLimit) {
        $now = new \DateTime();
        $userLimit->setCurrent($now);
        parent::prePersist($userLimit);
    }
    
    /**
     * {@inheritdoc}
     */
    public function preUpdate($userLimit) {
        $now = new \DateTime();
        $userLimit->setCurrent($now);
        parent::preUpdate($userLimit);
    }
}

<?php

namespace XYK\PMP\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class KnowledgeAreaAdmin extends Admin
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
            ->add('examType')  
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
            ->add('examType')  
        
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
            ->add('examType')  
           
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function prePersist($konwledgeArea) {
        $now = new \DateTime();
        $konwledgeArea->setCurrent($now);
        parent::prePersist($konwledgeArea);
    }
    
    /**
     * {@inheritdoc}
     */
    public function preUpdate($konwledgeArea) {
        $now = new \DateTime();
        $konwledgeArea->setCurrent($now);
        parent::preUpdate($konwledgeArea);
    }
}

<?php

namespace XYK\PMP\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ExamTypeAdmin extends Admin
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
            ->add('totalQuestions')
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
            ->add('totalQuestions')
            ->add('examMinutes')
            ->add('subGroup')
            ->add('groupMinutes')
            ->add('groupName')
            ->add('groupQuestions')
            ->add('areaName')
            ->add('areaQuestions')
        /*         ->add('users', 'sonata_type_collection', array(
                        'required' => false,
                        'by_reference' => false
                    ), array(
                        'edit' => 'inline',
                        'inline' => 'table'
                    ))*/
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
            ->add('totalQuestions')
            ->add('examMinutes')
            ->add('subGroup')
            ->add('groupMinutes')
            ->add('groupName')
            ->add('groupQuestions')
            ->add('areaName')
            ->add('areaQuestions') 
            /*    ->add('users')*/
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function prePersist($examType) {
        $now = new \DateTime();
        $examType->setCurrent($now);
         foreach($examType->getUsers() as $user)
        {
            $user->setExamType($user);
        }
        parent::prePersist($examType);
    }
    
    /**
     * {@inheritdoc}
     */
    public function preUpdate($examType) {
        $now = new \DateTime();
        $examType->setCurrent($now);
         foreach($examType->getUsers() as $user)
        {
            $user->setExamType($user);
        }
        parent::preUpdate($examType);
    }
}

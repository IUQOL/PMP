<?php

namespace XYK\PMP\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class QuestionAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('explanation')
            ->add('examType')    
            ->add('knowledgeArea')
            ->add('proccessGroup')
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
            ->add('examType')    
            ->add('knowledgeArea')
            ->add('proccessGroup')
            ->add('title')
            ->add('explanation')
             ->add('answers')
      
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('examType')    
            ->add('knowledgeArea')
            ->add('proccessGroup')
            ->add('title')
            ->add('explanation')
            ->add('answers')
            
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function prePersist($question) {
        $now = new \DateTime();
        $question->setCurrent($now);
        parent::prePersist($question);
    }
    
    /**
     * {@inheritdoc}
     */
    public function preUpdate($question) {
        $now = new \DateTime();
        $question->setCurrent($now);
        parent::preUpdate($question);
    }
}

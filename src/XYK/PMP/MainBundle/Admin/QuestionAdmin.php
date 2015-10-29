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
            ->addIdentifier('number')
            ->add('title')
            ->add('explanation')
            ->add('examType')  
            ->add('proccessGroup')
            ->add('knowledgeArea')
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
            ->add('proccessGroup')
            ->add('knowledgeArea')
            ->add('number')
            ->add('title')
            ->add('explanation')
            ->add('imageName')
            ->add('answers', 'sonata_type_collection', array(
                        'required' => false,
                        'by_reference' => false
                    ), array(
                        'edit' => 'inline',
                        'inline' => 'table'
                    ))
      
        ;
    }
    
    
    
    
    

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('examType')    
            ->add('proccessGroup')
            ->add('knowledgeArea')
            ->add('number')
            ->add('title')
            ->add('explanation')
            ->add('imageName')
            ->add('answers')
            
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function prePersist($question) {
        $now = new \DateTime();
        $question->setCurrent($now);
        foreach($question->getAnswers() as $answer)
        {
            $answer->setQuestion($question);
        }
        parent::prePersist($question);
    }
    
    /**
     * {@inheritdoc}
     */
    public function preUpdate($question) {
        $now = new \DateTime();
        $question->setCurrent($now);
        foreach($question->getAnswers() as $answer)
        {
            $answer->setQuestion($question);
        }
        parent::preUpdate($question);
    }
}

<?php

namespace XYK\PMP\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AnswerAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('question')
            ->add('description')
     
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        
        $listMapper
            ->add('question')
            ->addIdentifier('description')
            ->add('correct')
            
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
        //
        
        $parent = $this->parentFieldDescription;
        if( $parent != null)
        {
            $adminClass = $parent->getAdmin()->getClass();
            if($adminClass == 'XYK\PMP\EntityBundle\Entity\Question')
            {
                $formMapper
                  //  ->add('question')
                    ->add('description')
                    
                    ->add('correct',null,  array(
                                    'required' => false
                                ))
                ;
            }
            
        
        }
        else
        {
            $formMapper
                ->add('question')
                ->add('description')
                ->add('correct',null,  array(
                            'required' => false
                        ))

            ;
        }
        
        
        
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('question')
            ->add('description')
            ->add('correct')
         
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function prePersist($answer) {
        $now = new \DateTime();
        $answer->setCurrent($now);
        parent::prePersist($answer);
    }
    
    /**
     * {@inheritdoc}
     */
    public function preUpdate($answer) {
        $now = new \DateTime();
        $answer->setCurrent($now);
        parent::preUpdate($answer);
    }
}

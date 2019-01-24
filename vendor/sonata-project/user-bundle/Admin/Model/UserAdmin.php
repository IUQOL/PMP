<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\UserBundle\Admin\Model;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Model\UserInterface;

use FOS\UserBundle\Model\UserManagerInterface;
use DateInterval;

class UserAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    public function getFormBuilder()
    {
        $this->formOptions['data_class'] = $this->getClass();

        $options = $this->formOptions;
        $options['validation_groups'] = (!$this->getSubject() || is_null($this->getSubject()->getId())) ? 'Registration' : 'Profile';

        $formBuilder = $this->getFormContractor()->getFormBuilder( $this->getUniqid(), $options);

        $this->defineFormBuilder($formBuilder);

        return $formBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function getExportFields()
    {
        // avoid security field to be exported
        return array_filter(parent::getExportFields(), function($v) {
            return !in_array($v, array('password', 'salt'));
        });
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('email')
            //->add('groups')
            ->add('enabled', null, array('editable' => true))
            ->add('expired', null, array('editable' => false, 'label' =>'Expiró'))
            
            ->add('createdAt')
            ->add('expiresAt', null, array( 'label' =>'Expira'))
           // ->add('_action', 'actions', array(
           //     'actions' => array(
           //         'show' => array(),
           //     )
           // ))
        ;

//        if ($this->isGranted('ROLE_ALLOWED_TO_SWITCH')) {
//            $listMapper
//                ->add('impersonating', 'string', array('template' => 'SonataUserBundle:Admin:Field/impersonating.html.twig'))
//            ;
//        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            //->add('id')
            ->add('username')
            ->add('expired')
            ->add('email')
            ->add('groups')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
                ->add('username')
                ->add('email')
            ->end()
            ->with('Groups')
                ->add('groups')
            ->end()
            ->with('Profile')
                ->add('dateOfBirth')
                ->add('firstname')
                ->add('lastname')
             //   ->add('website')
             //   ->add('biography')
                ->add('gender')
             //   ->add('locale')
             //   ->add('timezone')
                ->add('phone')
            ->end()
          /*  ->with('Social')
                ->add('facebookUid')
                ->add('facebookName')
                ->add('twitterUid')
                ->add('twitterName')
                ->add('gplusUid')
                ->add('gplusName')
            ->end()
            ->with('Security')
                ->add('token')
                ->add('twoStepVerificationCode')
            ->end()*/
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $now = new \DateTime();
        // define group zoning
        
        $formMapper
            ->with('General')
                ->add('username')
                ->add('email')
                ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'required' => (!$this->getSubject() || is_null($this->getSubject()->getId())),
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => 'form.password'),
                    'second_options' => array('label' => 'form.password_confirmation'),
                    'invalid_message' => 'fos_user.password.mismatch',
                ))
                 ->add('expiresAt', 'date', array(
              
                'required' => true, 'label' =>'Expira'
            ))
                ->add('examType',null, array('required' => false ,'label' =>'Examen'))  
            ->end()
           
            ->with('Profile')
                //
                ->add('firstname', null, array('required' => false))
                ->add('lastname', null, array('required' => false))
             
                ->add('gender', 'sonata_user_gender', array(
                    'required' => true,
                    'translation_domain' => $this->getTranslationDomain()
                ))
               
                
         //      ->add('dateOfBirth', 'birthday', array('required' => false , 'type' => 'date'))
            ->add('phone', null, array('required' => false))
        
            ->end()
          
   
        ;

     //   if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Groups')

                ->add('groups', 'sonata_type_model', array(
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true
                ))
                ->add('locked', null, array('required' => false))
                ->add('expired', null, array('required' => false))
                ->add('enabled', null, array('required' => false))
            //    ->add('credentialsExpired', null, array('required' => false))
                ->end()
            ;
       // }

    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($user)
    {
        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
    }

    /**
     * @param UserManagerInterface $userManager
     */
    public function setUserManager(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->userManager;
    }
    
    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
      
        
        
        $em = $this->getModelManager()->getEntityManager('XYK\PMP\EntityBundle\Entity\ExamType');
          
        
        
      
        $query = $em->createQuery(
            'SELECT p
            FROM EntityBundle:ExamType p
            WHERE p.id = :id '
        )->setParameter('id', 1);

        $examType= $query->setMaxResults(1)->getOneOrNullResult();

        $em2 = $this->getModelManager()->getEntityManager('Application\Sonata\UserBundle\Entity\Group');
          
        
        
      
        $query2 = $em2->createQuery(
            'SELECT p
            FROM ApplicationSonataUserBundle:Group p
            WHERE p.id = :id '
        )->setParameter('id', 1);

        $group= $query2->setMaxResults(1)->getOneOrNullResult();
        
                   
        $date = new \DateTime();
        $interval = new DateInterval('P30D');
        $date->add($interval);
        $instance->setExpiresAt($date);
        $instance->addGroup($group);
        $instance->setExamType($examType);
        $instance->setEnabled(true);
        return $instance;
}
}

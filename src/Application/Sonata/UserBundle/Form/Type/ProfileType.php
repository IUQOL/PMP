<?php
/**
 * Created by PhpStorm.
 * User: DEV-006
 * Date: 15/01/15
 * Time: 09:45 AM
 */

namespace Application\Sonata\UserBundle\Form\Type;



use Sonata\UserBundle\Form\Type\ProfileType as SonataProfileType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\UserBundle\Model\UserInterface;


class ProfileType extends SonataProfileType
{

    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }
    
     /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('firstname', null, array(
                'label'    => 'form.label_firstname',
                'required' => true
            ))
            ->add('lastname', null, array(
                'label'    => 'form.label_lastname',
                'required' => true
            ))
            ->add('gender', 'sonata_user_gender', array(
                'label'    => 'form.label_gender',
                'required' => true,
                'translation_domain' => 'SonataUserBundle',
                'choices' => array(
                    UserInterface::GENDER_FEMALE => 'gender_female',
                    UserInterface::GENDER_MALE   => 'gender_male',
                )
            ))
            ->add('dateOfBirth', 'birthday', array(
                'label'    => 'form.label_date_of_birth',
                'required' => true,
                'widget'   => 'single_text'
            ))
            ->add('phone', null, array(
                'label'    => 'form.label_phone',
                'required' => false
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'show_legend' => false
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'security_sonata_user_profile';
    }
}
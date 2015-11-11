<?php
/**
 * Created by PhpStorm.
 * User: DEV-006
 * Date: 15/01/15
 * Time: 09:45 AM
 */

namespace Application\Sonata\UserBundle\Form\Type;



use FOS\UserBundle\Form\Type\ProfileType as BaseChangePasswordFormType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangePasswordFormType extends BaseChangePasswordFormType
{

    
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FOS\UserBundle\Form\Model\ChangePassword',
            'intention'  => 'change_password',
            'show_legend' => false,
        ));
        
    }
    
 
}
<?php
/**
 * Created by PhpStorm.
 * User: DEV-006
 * Date: 15/01/15
 * Time: 09:45 AM
 */

namespace Hiruko\SecurityBundle\Form\Type;



use FOS\UserBundle\Form\Type\ProfileFormType as BaseProfileFormType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileFormType extends BaseProfileFormType
{

    
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention'  => 'profile',
            'show_legend' => false
        ));
        
    }
    
}
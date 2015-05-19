<?php

namespace XYK\PMP\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserLimit
 */
class UserLimit
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $allowed;

    /**
     * @var integer
     */
    private $used;

    /**
     * @var \DateTime
     */
    private $current;

    /**
     * @var \XYK\PMP\EntityBundle\Entity\ExamType
     */
    private $examType;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $user;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set allowed
     *
     * @param integer $allowed
     * @return UserLimit
     */
    public function setAllowed($allowed)
    {
        $this->allowed = $allowed;

        return $this;
    }

    /**
     * Get allowed
     *
     * @return integer 
     */
    public function getAllowed()
    {
        return $this->allowed;
    }

    /**
     * Set used
     *
     * @param integer $used
     * @return UserLimit
     */
    public function setUsed($used)
    {
        $this->used = $used;

        return $this;
    }

    /**
     * Get used
     *
     * @return integer 
     */
    public function getUsed()
    {
        return $this->used;
    }

    /**
     * Set current
     *
     * @param \DateTime $current
     * @return UserLimit
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Get current
     *
     * @return \DateTime 
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * Set examType
     *
     * @param \XYK\PMP\EntityBundle\Entity\ExamType $examType
     * @return UserLimit
     */
    public function setExamType(\XYK\PMP\EntityBundle\Entity\ExamType $examType = null)
    {
        $this->examType = $examType;

        return $this;
    }

    /**
     * Get examType
     *
     * @return \XYK\PMP\EntityBundle\Entity\ExamType 
     */
    public function getExamType()
    {
        return $this->examType;
    }

    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @return UserLimit
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getUser().' - '. $this->getExamType().' - '. $this->getAllowed() ;
    }
}

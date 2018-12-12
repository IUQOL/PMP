<?php

namespace XYK\PMP\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exam
 */
class Exam
{
    /**
     * @var bigint
     */
    private $id;

    
    
    
    /**
     * @var bigint
     */
    private $timer;
    
    /**
     * @var boolean
     */
    private $finished;
    
     /**
     * @var boolean
     */
    private $area;
    
    /**
     * @var boolean
     */
    private $group;
    
    /**
     *
     * @var string
     */
    private $name;
    
    /**
     * @var float
     */
    private $percentage;

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
     * @return bigint 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set timer
     *
     * @param boolean $timer
     * @return Exam
     */
    public function setTimer($timer)
    {
        $this->timer = $timer+5000;

        return $this;
    }
    
    /**
     * Get id
     *
     * @return bigint 
     */
    public function getTimer()
    {
        return $this->timer;
    }

    /**
     * Set finished
     *
     * @param boolean $finished
     * @return Exam
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * Get finished
     *
     * @return boolean 
     */
    public function getFinished()
    {
        return $this->finished;
    }
    
    /**
     * Set area
     *
     * @param boolean $area
     * @return Exam
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return boolean 
     */
    public function getArea()
    {
        return $this->area;
    }
    
     /**
     * Set group
     *
     * @param boolean $group
     * @return Exam
     */
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return boolean 
     */
    public function getGroup()
    {
        return $this->group;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Exam
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * 
     * @param float $percentage
     * @return \XYK\PMP\EntityBundle\Entity\Exam
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
    
        return $this;
    }

    /**
     * 
     * @return float
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * Set current
     *
     * @param \DateTime $current
     * @return Exam
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
     * @return Exam
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
     * @return Exam
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
}

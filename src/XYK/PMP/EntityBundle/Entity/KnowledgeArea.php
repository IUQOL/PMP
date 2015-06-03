<?php

namespace XYK\PMP\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KnowledgeArea
 */
class KnowledgeArea
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return KnowledgeArea
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
     * Set description
     *
     * @param string $description
     * @return KnowledgeArea
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set percentage
     *
     * @param integer $percentage
     * @return KnowledgeArea
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * Get percentage
     *
     * @return integer 
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * Set current
     *
     * @param \DateTime $current
     * @return KnowledgeArea
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
     * @return KnowledgeArea
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
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}

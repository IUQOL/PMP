<?php

namespace XYK\PMP\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExamType
 */
class ExamType
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
    private $areaName;
    
    /**
     * @var string
     */
    private $groupName;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $totalQuestions;
    
    /**
     * @var integer
     */
    private $areaQuestions;
    
    /**
     * @var integer
     */
    private $groupQuestions;

    /**
     * @var \DateTime
     */
    private $current;
    
    /**
     *
     * @var integer 
     */
    private $examMinutes;
    
    /**
     *
     * @var integer 
     */
    private $groupMinutes;
    
    
    /**
     *
     * @var boolean 
     */
    private $subGroup;
    
       
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
     * @return ExamType
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
     * Set areaName
     *
     * @param string $areaName
     * @return ExamType
     */
    public function setAreaName($areaName)
    {
        $this->areaName = $areaName;

        return $this;
    }

    /**
     * Get areaName
     *
     * @return string 
     */
    public function getAreaName()
    {
        return $this->areaName;
    }

    /**
     * Set group Name
     *
     * @param string $groupName
     * @return ExamType
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;

        return $this;
    }

    /**
     * Get group Name
     *
     * @return string 
     */
    public function getGroupName()
    {
        return $this->groupName;
    }
    
    /**
     * Set description
     *
     * @param string $description
     * @return ExamType
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
     * Set totalQuestions
     *
     * @param integer $totalQuestions
     * @return ExamType
     */
    public function setTotalQuestions($totalQuestions)
    {
        $this->totalQuestions = $totalQuestions;

        return $this;
    }

    /**
     * Get totalQuestions
     *
     * @return integer 
     */
    public function getTotalQuestions()
    {
        return $this->totalQuestions;
    }

    /**
     * Set Area Questions
     *
     * @param integer $areaQuestions
     * @return ExamType
     */
    public function setAreaQuestions($areaQuestions)
    {
        $this->areaQuestions = $areaQuestions;

        return $this;
    }

    /**
     * Get Area Questions
     *
     * @return integer 
     */
    public function getAreaQuestions()
    {
        return $this->areaQuestions;
    }
    
    /**
     * Set Group Questions
     *
     * @param integer $groupQuestions
     * @return ExamType
     */
    public function setGroupQuestions($groupQuestions)
    {
        $this->groupQuestions = $groupQuestions;

        return $this;
    }

    /**
     * Get Group Questions
     *
     * @return integer 
     */
    public function getGroupQuestions()
    {
        return $this->groupQuestions;
    }
    
    
    /**
     * Set current
     *
     * @param \DateTime $current
     * @return ExamType
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
     * Set examMinutes
     *
     * @param integer $examMinutes
     * @return ExamType
     */
    public function setExamMinutes($examMinutes)
    {
        $this->examMinutes = $examMinutes;

        return $this;
    }

    /**
     * Get examMinutes
     *
     * @return integer 
     */
    public function getExamMinutes()
    {
        return $this->examMinutes;
    }
    
    /**
     * Set groupMinutes
     *
     * @param integer $groupMinutes
     * @return ExamType
     */
    public function setGroupMinutes($groupMinutes)
    {
        $this->groupMinutes = $groupMinutes;

        return $this;
    }

    /**
     * Get groupMinutes
     *
     * @return integer 
     */
    public function getGroupMinutes()
    {
        return $this->groupMinutes;
    }
    
    /**
     * Set subGroup
     *
     * @param boolean $subGroup
     * @return Exam
     */
    public function setSubGroup($subGroup)
    {
        $this->subGroup = $subGroup;

        return $this;
    }

    /**
     * Get subGroup
     *
     * @return boolean 
     */
    public function getSubGroup()
    {
        return $this->subGroup;
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

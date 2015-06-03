<?php

namespace XYK\PMP\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 */
class Question
{
    /**
     * @var bigint
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $explanation;

    /**
     * @var \DateTime
     */
    private $current;

    /**
     * @var \XYK\PMP\EntityBundle\Entity\ExamType
     */
    private $examType;

    /**
     * @var \XYK\PMP\EntityBundle\Entity\KnowledgeArea
     */
    private $knowledgeArea;

    /**
     * @var \XYK\PMP\EntityBundle\Entity\ProccessGroup
     */
    private $proccessGroup;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $answers;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set title
     *
     * @param string $title
     * @return Question
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set explanation
     *
     * @param string $explanation
     * @return Question
     */
    public function setExplanation($explanation)
    {
        $this->explanation = $explanation;

        return $this;
    }

    /**
     * Get explanation
     *
     * @return string 
     */
    public function getExplanation()
    {
        return $this->explanation;
    }

    /**
     * Set current
     *
     * @param \DateTime $current
     * @return Question
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
     * @return Question
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
     * Set knowledgeArea
     *
     * @param \XYK\PMP\EntityBundle\Entity\KnowledgeArea $knowledgeArea
     * @return Question
     */
    public function setKnowledgeArea(\XYK\PMP\EntityBundle\Entity\KnowledgeArea $knowledgeArea = null)
    {
        $this->knowledgeArea = $knowledgeArea;

        return $this;
    }

    /**
     * Get knowledgeArea
     *
     * @return \XYK\PMP\EntityBundle\Entity\KnowledgeArea 
     */
    public function getKnowledgeArea()
    {
        return $this->knowledgeArea;
    }

    /**
     * Set proccessGroup
     *
     * @param \XYK\PMP\EntityBundle\Entity\ProccessGroup $proccessGroup
     * @return Question
     */
    public function setProccessGroup(\XYK\PMP\EntityBundle\Entity\ProccessGroup $proccessGroup = null)
    {
        $this->proccessGroup = $proccessGroup;

        return $this;
    }

    /**
     * Get proccessGroup
     *
     * @return \XYK\PMP\EntityBundle\Entity\ProccessGroup 
     */
    public function getProccessGroup()
    {
        return $this->proccessGroup;
    }
    
    /**
     * 
     * @param \XYK\PMP\EntityBundle\Entity\Answer $answers
     * @return \XYK\PMP\EntityBundle\Entity\Question
     */
    public function addAnswer(\XYK\PMP\EntityBundle\Entity\Answer $answers)
    {
        $answers->setQuestion($this);
        $now = new \DateTime();
        $answers->setCurrent($now);
        $this->answers[] = $answers;
    
        return $this;
    }

    /**
     * 
     * @param \XYK\PMP\EntityBundle\Entity\Answer $answers
     */
    public function removeAnswer(\XYK\PMP\EntityBundle\Entity\Answer $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }
    
    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}

<?php

namespace XYK\PMP\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExamQuestion
 */
class ExamQuestion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $order;

    /**
     * @var boolean
     */
    private $solved;

    /**
     * @var \DateTime
     */
    private $current;

    /**
     * @var \XYK\PMP\EntityBundle\Entity\ExamType
     */
    private $exam;

    /**
     * @var \XYK\PMP\EntityBundle\Entity\Question
     */
    private $question;

    /**
     * @var \XYK\PMP\EntityBundle\Entity\Answer
     */
    private $answer;


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
     * Set order
     *
     * @param integer $order
     * @return ExamQuestion
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set solved
     *
     * @param boolean $solved
     * @return ExamQuestion
     */
    public function setSolved($solved)
    {
        $this->solved = $solved;

        return $this;
    }

    /**
     * Get solved
     *
     * @return boolean 
     */
    public function getSolved()
    {
        return $this->solved;
    }

    /**
     * Set current
     *
     * @param \DateTime $current
     * @return ExamQuestion
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
     * Set exam
     *
     * @param \XYK\PMP\EntityBundle\Entity\ExamType $exam
     * @return ExamQuestion
     */
    public function setExam(\XYK\PMP\EntityBundle\Entity\ExamType $exam = null)
    {
        $this->exam = $exam;

        return $this;
    }

    /**
     * Get exam
     *
     * @return \XYK\PMP\EntityBundle\Entity\ExamType 
     */
    public function getExam()
    {
        return $this->exam;
    }

    /**
     * Set question
     *
     * @param \XYK\PMP\EntityBundle\Entity\Question $question
     * @return ExamQuestion
     */
    public function setQuestion(\XYK\PMP\EntityBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \XYK\PMP\EntityBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param \XYK\PMP\EntityBundle\Entity\Answer $answer
     * @return ExamQuestion
     */
    public function setAnswer(\XYK\PMP\EntityBundle\Entity\Answer $answer = null)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return \XYK\PMP\EntityBundle\Entity\Answer 
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}

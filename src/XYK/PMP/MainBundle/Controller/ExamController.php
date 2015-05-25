<?php

namespace XYK\PMP\MainBundle\Controller;


use XYK\PMP\EntityBundle\Entity\Question;
use XYK\PMP\EntityBundle\Entity\Exam;
use XYK\PMP\EntityBundle\Entity\ExamQuestion;
use Doctrine\Common\Collections\Collection;
use Sonata\UserBundle\Model\UserInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExamController extends Controller
{
    
    /**
     * Generate render for a question
     * @param type $id
     */
    public function questionAction($id)
    {
        $question = $this->getDoctrine()
        ->getRepository('EntityBundle:Question')
        ->findOneById($id);

        if (!$question) {
            throw $this->createNotFoundException(
                'No question found for id '.$id
            );
        }
        
        $answers = $this->getDoctrine()
        ->getRepository('EntityBundle:Answer')
        ->findBy(array('question' => $question));
        
        if (!$answers) {
            throw $this->createNotFoundException(
                'No answers found for question '
            );
        }
        
        $answers2 = $this->rasndomizeArray($answers);
        $option1 = $option2 = $option3 = $option4 = null;
        if (sizeof($answers) >=4)
        {
            $option1 = $answers2[0];
            $option2 = $answers2[1];
            $option3 = $answers2[2];
            $option4 = $answers2[3];
        }
        
        $answered = false;
        $explanation = false;
        $option = 1;
        
        return $this->render('MainBundle:Forms:question.html.twig', 
                array(
                    'Title' => $question->getTitle(),
                    'Option1' => $option1,
                    'Option2' => $option2,
                    'Option3' => $option3,
                    'Option4' => $option4,
                    'Explanation' => $question->getExplanation(),
                    'ShowExplanation' => $explanation,
                    'Answered' => $answered,
                    'Answer' => $option,
                ));
    }
    
    /**
     * 
     * @param type $idExamType
     * @param type $idType
     * @param type $idGroup
     * @return type
     * @throws AccessDeniedException
     * @throws NotFoundException
     */
    public function generateExamAction($idExamType, $idType = -1, $idGroup = -1)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        
        $em = $this->getDoctrine()->getManager();
        
       
        
        
        $examType = $this->getDoctrine()
        ->getRepository('EntityBundle:ExamType')
        ->findOneById($idExamType);
        
        if (!$examType) {
            throw $this->createNotFoundException(
                'No exanType  found for id '.$idExamType
            );
        }
        
        $exam = new Exam();
        $now = new \DateTime();
        
        $exam->setExamType($examType);
        $exam->setFinished(false);
        $exam->setUser($user);
        $exam->setCurrent($now);
        

        $em->persist($exam);
        
        $em->flush();
        
        
        
        $proccess = null;
        $questions = null;
        $result = null;
        if ($idType !=-1 && $idGroup != -1)
        {
            if($idType == 1)
            {
            
                $proccess = $this->getDoctrine()
                ->getRepository('EntityBundle:ProccessGroup')
                ->findOneById($idGroup);

                $questions = $this->getDoctrine()
                ->getRepository('EntityBundle:Question')
                ->findBy(array('proccessGroup' => $proccess));
                $this->createExam($examType, $questions, $em, $exam);
            
            }
            else
            {
                $knowledge = $this->getDoctrine()
                ->getRepository('EntityBundle:KnowledgeArea')
                ->findOneById($idGroup);

                $questions = $this->getDoctrine()
                ->getRepository('EntityBundle:Question')
                ->findBy(array('knowledgeArea' => $knowledge));
                $this->createExam($examType, $questions, $em, $exam);
                
            }
        }
        else
        {
            $proccess = $this->getDoctrine()
            ->getRepository('EntityBundle:ProccessGroup')
            ->findAll();
            
            foreach ($proccess as $proc)
            {
                $questions = $this->getDoctrine()
                ->getRepository('EntityBundle:Question')
                ->findBy(array('proccessGroup' => $proc));

                $q2 = $this->rasndomizeArray($questions);
                $numQuest = $this->totalQuestions($examType, $proc);
                for ($x = 0; $x <= $numQuest; $x++)
                {
                    $result[] = $q2[$x];
                }
                
            }
            $this->createExam($examType, $result, $em, $exam);
        }
        
        
        return $this->render('MainBundle:Default:index.html.twig', array('name' => 'HI'));
    }
    
   
    private function createExam($examType, $questions, $em, $exam )
    {
        $now = new \DateTime();
        $result = $this->rasndomizeArray($questions);
        for ($x = 0; $x < $examType->getTotalQuestions(); $x++)
            {

                $examQuestion = new ExamQuestion();
                $examQuestion->setCurrent($now);
                $examQuestion->setExam($exam);
                $examQuestion->setOrder($x+1);
                $examQuestion->setSolved(false);
                $examQuestion->setQuestion($result[$x]);
                $em->persist($examQuestion);
            }
            $em->flush(); 
    }
    
    private function totalQuestions($examType, $proc)
    {
        return ($examType->getTotalQuestions() * $proc->getPercentage())/100;
    }
    
    
    public function indexAction($name)
    {
        return $this->render('MainBundle:Default:index.html.twig', array('name' => $name));
    }
    
    /**
     * randomize an array
     * @param array $array
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    private function rasndomizeArray($array)
    {
        $result = new \Doctrine\Common\Collections\ArrayCollection();
        if(shuffle($array))
        {
            $result = $array;
        }
        return $result;
    }
}
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
    public function questionAction($id, $idExam = null)
    {
        $exam = null;
        $answered = $showExam  = $previous =$next = false;
        $explanation = true;
        if($idExam != -1)
        {
           $exam = $this->getDoctrine()
            ->getRepository('EntityBundle:Exam')
            ->findOneById($idExam); 
           $answered = $exam->getFinished();
           $showExam = true; 
           if(!$answered)
           {
               $explanation = false;
           }
           $previous = $next = true;
        }
        
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
        $option = -1;
        $prevId = $nextId = -1;
        if($exam != null)
        {
            $examQuestion = $this->getDoctrine()
            ->getRepository('EntityBundle:ExamQuestion')
            ->findOneBy(array('exam' => $exam, 'question' => $question));
            
            if($examQuestion->getSolved())
            {
                if($examQuestion->getAnswer()->getId() == $option1->getId())
                {
                    $option =1;
                }
                if($examQuestion->getAnswer()->getId() == $option2->getId())
                {
                    $option =2;
                }
                if($examQuestion->getAnswer()->getId() == $option3->getId())
                {
                    $option =3;
                }
                if($examQuestion->getAnswer()->getId() == $option4->getId())
                {
                    $option =4;
                }
            }
            if($examQuestion->getOrder() == 1)
            {
                $previous = false;
                $examQuestionNext = $this->getDoctrine()
                ->getRepository('EntityBundle:ExamQuestion')
                ->findOneBy(array('exam' => $exam, 'order' => $examQuestion->getOrder() + 1 ));
                $nextId = $examQuestionNext->getQuestion()->getId();
            }
            elseif($examQuestion->getOrder() == $exam->getExamType()->getTotalQuestions())
            {
                $next = false;
                $examQuestionPrev = $this->getDoctrine()
                ->getRepository('EntityBundle:ExamQuestion')
                ->findOneBy(array('exam' => $exam, 'order' => $examQuestion->getOrder() - 1));
                $prevId = $examQuestionPrev->getQuestion()->getId();
            }
            else
            {
                $examQuestionNext = $this->getDoctrine()
                ->getRepository('EntityBundle:ExamQuestion')
                ->findOneBy(array('exam' => $exam, 'order' => $examQuestion->getOrder() + 1 ));
                $nextId = $examQuestionNext->getQuestion()->getId();
                $examQuestionPrev = $this->getDoctrine()
                ->getRepository('EntityBundle:ExamQuestion')
                ->findOneBy(array('exam' => $exam, 'order' => $examQuestion->getOrder() - 1));
                $prevId = $examQuestionPrev->getQuestion()->getId();
            }
            
            $examQuestionNext = $this->getDoctrine()
            ->getRepository('EntityBundle:ExamQuestion')
            ->findOneBy(array('exam' => $exam, 'question' => $question));
            
            $examQuestionPrev = $this->getDoctrine()
            ->getRepository('EntityBundle:ExamQuestion')
            ->findOneBy(array('exam' => $exam, 'question' => $question));
            
        }
        
       
        
        
        return $this->render('MainBundle:Forms:question.html.twig', 
                array(
                    'Title' => $question->getTitle(),
                    'Option1' => $option1,
                    'Option2' => $option2,
                    'Option3' => $option3,
                    'Option4' => $option4,
                    'Explanation' => $question->getExplanation(),
                    'ShowExplanation' => $explanation,
                    'ShowPrevious' => $previous,
                    'ShowNext' => $next,
                    'ShowExam' => $showExam,
                    'exam' => $exam,
                    'prevId' => $prevId,
                    'nextId' => $nextId,
                    'Answered' => $answered,
                    'Answer' => $option,
                    'IdExam' => $idExam,
                    'ExamQuestion' => $examQuestion,
                    'QuestionId' => $question->getId(),
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
    public function generateExamAction($idExam = -1, $idExamType =1, $idType = -1, $idGroup = -1)
    {
        $exam = null;
        if($idExam == -1)
        {
            $exam = $this->createExam($idExamType, $idType, $idGroup);
        }
        else
        {
           $exam = $this->getDoctrine()
            ->getRepository('EntityBundle:Exam')
            ->findOneById($idExam); 
        }
        
        $questions = $this->getDoctrine()
            ->getRepository('EntityBundle:ExamQuestion')
            ->findBy(array('exam' => $exam), array('order' => 'ASC'));
          
        
        $numQuestions = intval((sizeof($questions))/11);
        $numQuestions2 = intval((sizeof($questions))%11);
        
        
        $questions1 = $questions2 = $questions3 = $questions4 =  $questions5 = $questions6 = $questions7 = $questions8 = $questions9 = $questions10  = $questions11 = $questions12=null; 
          
        
        for($i=0; $i< $numQuestions; $i++)
        {
            $questions1[] =  $questions[$i];
        }
        for($i=$numQuestions; $i< $numQuestions *2; $i++)
        {
            $questions2[] =  $questions[$i];
        }
        for($i=$numQuestions*2; $i< $numQuestions*3; $i++)
        {
            $questions3[] =  $questions[$i];
        }
        for($i=$numQuestions*3; $i< $numQuestions*4; $i++)
        {
            $questions4[] =  $questions[$i];
        }
        for($i=$numQuestions*4; $i< $numQuestions *5; $i++)
        {
            $questions5[] =  $questions[$i];
        }
        for($i=$numQuestions*5; $i< $numQuestions *6; $i++)
        {
            $questions6[] =  $questions[$i];
        }
        for($i=$numQuestions*6; $i< $numQuestions *7; $i++)
        {
            $questions7[] =  $questions[$i];
        }
        for($i=$numQuestions*7; $i< $numQuestions*8; $i++)
        {
            $questions8[] =  $questions[$i];
        }
        for($i=$numQuestions*8; $i< $numQuestions*9; $i++)
        {
            $questions9[] =  $questions[$i];
        }
        for($i=$numQuestions*9; $i< $numQuestions*10; $i++)
        {
            $questions10[] =  $questions[$i];
        }
        for($i=$numQuestions*10; $i< $numQuestions*11; $i++)
        {
            $questions11[] =  $questions[$i];
        }
        for($i=$numQuestions*11; $i< ($numQuestions*11)+$numQuestions2; $i++)
        {
            $questions12[] =  $questions[$i];
        }
        
        
        
        
        return $this->render('MainBundle:Forms:exam.html.twig', 
                array(
                    'exam' => $exam,
                    'questions1' => $questions1,
                    'questions2' => $questions2,
                    'questions3' => $questions3,
                    'questions4' => $questions4,
                    'questions5' => $questions5,
                    'questions6' => $questions6,
                    'questions7' => $questions7,
                    'questions8' => $questions8,
                    'questions9' => $questions9,
                    'questions10' => $questions10,
                    'questions11' => $questions11,
                    'questions12' => $questions12,
                    
                    
                ));
    }
            
    
    public function solveQuestionAction()
    {
        
        $idExamQuestion=$_POST['idExamQuestion'];
        $idAnswer= $_POST['idAnswer'];
    
        $answer = $this->getDoctrine()
            ->getRepository('EntityBundle:Answer')
            ->findOneById($idAnswer);
        
        if ($answer) {
            $em = $this->getDoctrine()->getManager();
            $examQuestion = $this->getDoctrine()
                ->getRepository('EntityBundle:ExamQuestion')
                ->findOneById($idExamQuestion);
        
       
        
            $examQuestion->setSolved(true);
            $examQuestion->setAnswer($answer);

            $em->persist($examQuestion);
            $em->flush();
        
        }
        
        
        return new \Symfony\Component\HttpFoundation\Response(json_encode($examQuestion));
    }
    
    public function finishExamAction()
    {
        $idExam=$_POST['idExam'];
        $exam = $this->getDoctrine()
            ->getRepository('EntityBundle:Exam')
            ->findOneById($idExam);
        
        if ($exam) 
        { 
            $em = $this->getDoctrine()->getManager();
            $exam->setFinished(true);
            $em->persist($exam);
            $em->flush();
        }
        return new \Symfony\Component\HttpFoundation\Response(json_encode($exam));
    }
    
    private function createExam($idExamType =1, $idType = -1, $idGroup = -1)
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
                $this->createExamQuestions($examType, $questions, $em, $exam);

            }
            else
            {
                $knowledge = $this->getDoctrine()
                ->getRepository('EntityBundle:KnowledgeArea')
                ->findOneById($idGroup);

                $questions = $this->getDoctrine()
                ->getRepository('EntityBundle:Question')
                ->findBy(array('knowledgeArea' => $knowledge));
                $this->createExamQuestions($examType, $questions, $em, $exam);

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
            $this->createExamQuestions($examType, $result, $em, $exam);
        }
        return $exam;
    }
    
   
    private function createExamQuestions($examType, $questions, $em, $exam )
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
<?php

namespace XYK\PMP\MainBundle\Controller;


use XYK\PMP\EntityBundle\Entity\Question;
use XYK\PMP\EntityBundle\Entity\Exam;
use XYK\PMP\EntityBundle\Entity\ExamQuestion;
use Doctrine\Common\Collections\Collection;
use Sonata\UserBundle\Model\UserInterface;
use Ob\HighchartsBundle\Highcharts\Highchart;

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
        $rev = false;
        $total =0;
        $count =0;
        
        $date =0;
         $time = false;
                    
        $timer = 1;
        if($idExam != null)
        {
           $exam = $this->getDoctrine()
            ->getRepository('EntityBundle:Exam')
            ->findOneById($idExam); 
           $answered = $exam->getFinished();
           $showExam = true; 
           
           $timer = $exam->getTimer();
           
           $previous = $next = true;
           if($exam->getGroup())
           {
               $total = $exam->getExamType()->getGroupQuestions();
           }
           elseif($exam->getArea())
           {
               $total = $exam->getExamType()->getAreaQuestions();
           }
           else
           {
               $total = $exam->getExamType()->getTotalQuestions();
           }
           
           if(!$answered)
           {
               if($exam->getGroup() || $exam->getArea())
               {
                  $explanation = true; 
               }
               else
               {
                   $explanation = false; 
               }
               
               $time = true;
        //       $timer = $timer * $total;
               $date = $exam->getCurrent()->getTimestamp()*1000 + $timer;
               
               
           }
           
           
           
        }
        
        $question = $this->getDoctrine()
        ->getRepository('EntityBundle:Question')
        ->findOneById($id);

        if (!$question) {
           return $this->render('MainBundle:Forms:question.html.twig', 
                array(
                    'QuestionId' => -1,
                    'Time' => false,
                     'Date'  => $date,));
            
            
        }
        
        $answers = $this->getDoctrine()
        ->getRepository('EntityBundle:Answer')
        ->findBy(array('question' => $question));
        
        if (!$answers) {
           return $this->render('MainBundle:Forms:question.html.twig', 
                array(
                    'QuestionId' => -1,
                     'Time' => false,
                     'Date'  => $date,));
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
        $examQuestion = null;
        if($exam != null)
        {
            $examQuestion = $this->getDoctrine()
            ->getRepository('EntityBundle:ExamQuestion')
            ->findOneBy(array('exam' => $exam, 'question' => $question));
            $count = $examQuestion->getOrder(); 
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
            
            $questionsNumber =0;
            
            if($exam->getGroup())
        {
            $questionsNumber = $exam->getExamType()->getGroupQuestions();
            
        }
        elseif($exam->getArea())
        {
            $questionsNumber = $exam->getExamType()->getAreaQuestions();
        }
        else 
        {
            $questionsNumber = $exam->getExamType()->getTotalQuestions();
        }
            
            if($examQuestion->getOrder() == 1)
            {
                $previous = true;
                //Get previous with number of questions
                  $examQuestionPrev = $this->getDoctrine()
                ->getRepository('EntityBundle:ExamQuestion')
                ->findOneBy(array('exam' => $exam, 'order' => $questionsNumber));
                $prevId = $examQuestionPrev->getQuestion()->getId();
                $examQuestionNext = $this->getDoctrine()
                ->getRepository('EntityBundle:ExamQuestion')
                ->findOneBy(array('exam' => $exam, 'order' => $examQuestion->getOrder() + 1 ));
                $nextId = $examQuestionNext->getQuestion()->getId();
            }
            elseif($examQuestion->getOrder() == $questionsNumber)
            {
                $next = true;
                //Prev is question 1
                 $examQuestionNext = $this->getDoctrine()
                ->getRepository('EntityBundle:ExamQuestion')
                ->findOneBy(array('exam' => $exam, 'order' => 1));
                $nextId = $examQuestionNext->getQuestion()->getId();
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
            $rev = $examQuestion->getRevision();
        }
        
        $hasImage = empty($question->getImageName());
        $examtype = $question->getExamType()->getId();
        
        $imageName = $examtype.'/'.$question->getImageName().'.JPG';
        
        
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
                    'Total' => $total,
                    'Count' => $count,
                    'Timer' => $timer,
                    'Date'  => $date,
                    'Time'  => $time,
                    'Image' => $hasImage,
                    'ImageName' =>$imageName,
                    'ExamQuestion' => $examQuestion,
                    'QuestionId' => $question->getNumber(),
                    'Revision' => $rev, 
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
        $timer = $exam->getTimer();
        
        $questions = $this->getDoctrine()
            ->getRepository('EntityBundle:ExamQuestion')
            ->findBy(array('exam' => $exam), array('order' => 'ASC'));
          
        
        
       
        
        $total=0;
        if($exam->getGroup())
           {
               $total = $exam->getExamType()->getGroupQuestions();
           }
           elseif($exam->getArea())
           {
               $total = $exam->getExamType()->getAreaQuestions();
           }
           else
           {
               $total = $exam->getExamType()->getTotalQuestions();
           }
        if($idExam == -1)
        {
            $this->updateExamCurrent($exam->getId());
        }
        $date = $exam->getCurrent()->getTimestamp()*1000 + ($timer);
           //     *$total);
        
        $time = $exam->getFinished();
      /*  if($idExam == -1)
        {
          $this->questionAction($questions[0]->getId(),$exam->getId());
        }
        else
        {*/
        return $this->render('MainBundle:Forms:exam.html.twig', 
                array(
                    'exam' => $exam,
                    'questions' => $questions,
                   
                    'Date' => $date,
                    'Time' => $time,
                    
                    
                ));
       // }
    }
            
    
    public function solveQuestionAction()
    {
        
        $idExamQuestion=$_POST['idExamQuestion'];
        $idAnswer= $_POST['idAnswer'];
        $revision= $_POST['revision'];
    
        $answer = $this->getDoctrine()
            ->getRepository('EntityBundle:Answer')
            ->findOneById($idAnswer);
        
        
            $em = $this->getDoctrine()->getManager();
            $examQuestion = $this->getDoctrine()
                ->getRepository('EntityBundle:ExamQuestion')
                ->findOneById($idExamQuestion);
            $examQuestion->setRevision($revision);
            if ($answer) {
            $examQuestion->setSolved(true);
            $examQuestion->setAnswer($answer);
            }
            $em->persist($examQuestion);
            $em->flush();
        
        
        
        
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
            $questions = $this->getDoctrine()
                ->getRepository('EntityBundle:ExamQuestion')
                ->findBy(array('exam' => $exam), array('order' => 'ASC'));
            $correct =0;
            foreach ($questions as $question)
            {
                if($question->getSolved() && $question->getAnswer()->getCorrect())
                {
                    $correct++;
                }
            }
            $questionsNumber =0;
            $groupQ = $exam->getGroup();
            $areaQ = $exam->getArea();
            if($groupQ)
            {
                $questionsNumber = $exam->getExamType()->getGroupQuestions();

            }
            elseif($areaQ)
            {
                $questionsNumber = $exam->getExamType()->getAreaQuestions();
            }
            else 
            {
                $questionsNumber = $exam->getExamType()->getTotalQuestions();
            } 
            
            $percentage = ($correct * 100)/ $questionsNumber;
            
            $em = $this->getDoctrine()->getManager();
            $exam->setFinished(true);
            $exam->setPercentage($percentage);
            $em->persist($exam);
            $em->flush();
        }
        return new \Symfony\Component\HttpFoundation\Response(json_encode($exam));
    }
    
    public function historyAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        
        $examns = $this->getDoctrine()
            ->getRepository('EntityBundle:Exam')
            ->findBy(array('user' => $user, 'finished' => true), array('current' => 'ASC'));
        
        return $this->render('MainBundle:Forms:examList.html.twig', 
                array(
                    'examns' => $examns,
                ));
        
    }
    
    
    public function reportingAction()
    {
        $usuarios = null;
        $users  = $this->getDoctrine()
            ->getRepository('ApplicationSonataUserBundle:User')
            ->findBy(array(), array('lastname'=>'asc', 'firstname' => 'asc', 'username' => 'asc'));
        
        foreach( $users as $user)
        {
        
         $examns = $this->getDoctrine()
            ->getRepository('EntityBundle:Exam')
            ->findBy(array('user' => $user, 'finished' => true), array('current' => 'ASC'));
         
         if(!empty($examns))
         {
           $usuarios[] = array('nombre' => $user->getFirstname().' '.$user->getLastname(),
                                'username' => $user->getUsername() ,
                                'examenes' => sizeof($examns),
                                'examns' => $examns);
         }
         
        }
        return $this->render('MainBundle:Forms:report.html.twig', 
                array(
                    'users' => $usuarios,
                ));
    }
    
    
    public function searchAction()
    {
        
         $this->translator = $this->container->get('translator');
        $security = $this->container->get('security.context'); //->isGranted('ROLE_SUPER_ADMIN');
        $token = $security->getToken();
     
        
        $idTypeExam = $token->getUser()->getExamType()->getId();
        if ($token != null && ($security->isGranted('ROLE_SONATA_ADMIN') || $security->isGranted('ROLE_SUPER_ADMIN'))) {
          
            $types = $this->getDoctrine()
            ->getRepository('EntityBundle:ExamType')
            ->findAll();
        }
        else
        {
            
            $types = $this->getDoctrine()
            ->getRepository('EntityBundle:ExamType')
            ->findAllById($idTypeExam);
        }
        
        
        
        
       
       
        return $this->render('MainBundle:Forms:selectQuestion.html.twig', 
                array(
                    'types' => $types,
                    'errort' => false,
                    
                ));
    }
    
    public function searchQuestionAction()
    {
        $idQuestion=$_POST['idQuestion'];
       $idTypeExam=$_POST['idTypeExam'];
        
        $user = $this->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        
        $examType = $this->getDoctrine()
            ->getRepository('EntityBundle:ExamType')
            ->findOneById($idTypeExam);
        
       
                     
        
        
        
        if (is_numeric ( $idQuestion ))
        {
             $question = $this->getDoctrine()
                ->getRepository('EntityBundle:Question')
                ->findOneBy(array('examType' => $examType, 'number' => $idQuestion));
             
            return $this->questionAction(intval($question->getId()));
        }
        else {
            return $this->questionAction(-1);
        }
        
    }
    
    public function areaAction($idTypeExam, $idType)
    {
        $type = $this->getDoctrine()
            ->getRepository('EntityBundle:ExamType')
            ->findOneById($idTypeExam);
        $proceses = $this->getDoctrine()
            ->getRepository('EntityBundle:ProccessGroup')
            ->findBy(array('examType' => $type),
                     array('id' => 'ASC'));
        $areas = $this->getDoctrine()
            ->getRepository('EntityBundle:KnowledgeArea')
            ->findBy(array('examType' => $type),
                     array('id' => 'ASC'));
        $groups = null;
        $groupName = '';
        if($idType == 1)
        {
            $groups = $proceses;
            $groupName = $type->getGroupName();
        }
        else
        {
            $groups = $areas;
            $groupName = $type->getAreaName();
        }
        return $this->render('MainBundle:Forms:selectArea.html.twig', 
                array(
                    'idTypeExam' => $type->getId(),
                    'idType' => $idType,
                    'groups' => $groups,
                    'groupName' => $groupName,
                ));
    }
    
    public function areaExamAction()
    {
        $idType =$_POST['idType'];
        $idTypeExam=$_POST['idTypeExam'];
        $idGroup=$_POST['idGroup'];
        
        return $this->generateExamAction(-1, $idTypeExam , $idType , $idGroup);
        
        //return new \Symfony\Component\HttpFoundation\Response();
    }
    
    public function getExamAction()
    {
     
        $this->translator = $this->container->get('translator');
        $security = $this->container->get('security.context'); //->isGranted('ROLE_SUPER_ADMIN');
        $token = $security->getToken();
     
        
        $idTypeExam = $token->getUser()->getExamType()->getId();
        if ($token != null && ($security->isGranted('ROLE_SONATA_ADMIN') || $security->isGranted('ROLE_SUPER_ADMIN'))) {
          
             $types = $this->getDoctrine()
           ->getRepository('EntityBundle:ExamType')
  
            ->findAll();
       
            return $this->render('MainBundle:Forms:selectExam.html.twig', 
                    array(
                        'types' => $types,
                        'errort' => false,

                    ));
        }
        else
        {
            
            return $this->generateExamAction(-1, $idTypeExam , -1 , -1);
        }
        
        
      
    }
    
    public function createExamAction()
    {
        $idTypeExam=$_POST['idTypeExam'];
        
        $user = $this->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        
        $examType = $this->getDoctrine()
            ->getRepository('EntityBundle:ExamType')
            ->findOneById($idTypeExam);
        
        $userLimit = $this->getDoctrine()
            ->getRepository('EntityBundle:UserLimit')
            ->findOneBy(array('user' => $user, 'examType' => $examType));
        
        $types = $this->getDoctrine()
            ->getRepository('EntityBundle:ExamType')
            ->findAll();
        
        if($userLimit)
        {
            if($userLimit->getUsed() < $userLimit->getAllowed())
            {
                $used = $userLimit->getUsed() +1;
                $userLimit->setUsed($used);
                $em = $this->getDoctrine()->getManager();
            
                $em->persist($userLimit);
                $em->flush();
                return $this->generateExamAction(-1, $idTypeExam , -1 , -1);
            }
            else {
                return $this->render('MainBundle:Forms:selectExam.html.twig', 
                array(
                    'types' => $types,
                    'errort' => true,
                    
                ));
                
            }
        }
        
        return $this->generateExamAction(-1, $idTypeExam , -1 , -1);
        
        //return new \Symfony\Component\HttpFoundation\Response();
    }
    
    public function reportAction($idExam)
    {
        $exam = $this->getDoctrine()
            ->getRepository('EntityBundle:Exam')
            ->findOneById($idExam); 
        
        $charts = $this->getCharts($exam);
        $charts2 = $this->getCharts2($exam);
        
        $questions = $this->getDoctrine()
            ->getRepository('EntityBundle:ExamQuestion')
            ->findBy(array('exam' => $exam), array('order' => 'ASC'));
        
        $questions2 = array();
        
        foreach($questions as $question)
        {
            $correct = false;
            if($question->getSolved() && $question->getAnswer()->getCorrect())
            {
                $correct = true;
            }
          $group = "";
            if(!is_null($question->getQuestion()->getProccessGroup()))
           {
               $group = $question->getQuestion()->getProccessGroup()->getName();
           }
           $area= "";
            if(!is_null($question->getQuestion()->getKnowledgeArea()))
           {
               $area = $question->getQuestion()->getKnowledgeArea()->getName();
           } 
            $questions2 [] = array(
          
             
           // array('Correctas', $correct),
           // array('Incorrectas', $incorrect),
           'id' => $question->getQuestion()->getId(),
           'order' => $question->getOrder(),
           'grupo' => $group,
           'area'=> $area,
           'correct' => $correct,
         );
        }
        
        return $this->render('MainBundle:Forms:examReport.html.twig',
                array(
                    'exam' => $exam,
                    'charts' => $charts,
                    'charts2' => $charts2,
                    'questions' => $questions2,
                    'GroupName' => $exam->getExamType()->getGroupName(), 
                    'AreaName' => $exam->getExamType()->getAreaName()
                ));
        
    }
    private function updateExamCurrent($idExam)
    {
         $em = $this->getDoctrine()->getManager();
         $exam = $this->getDoctrine()
            ->getRepository('EntityBundle:Exam')
            ->findOneById($idExam); 
        $now = new \DateTime();
        $exam->setCurrent($now);
         $em->persist($exam);

        $em->flush();
         
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

        $examTimer = /*round((*/
                $examType->getExamMinutes()*60000;
            /*)/ $examType->getTotalQuestions(),0, PHP_ROUND_HALF_UP);*/
        $groupTimer = $examType->getGroupMinutes()*60000;
        
        
        $exam->setExamType($examType);
        $exam->setFinished(false);
        $exam->setUser($user);
        $exam->setPercentage(0);
        $exam->setCurrent($now);
        if($idType == 1)
        {
            $exam->setGroup(true);
            $exam->setArea(false);
            $exam->setTimer($groupTimer);
                    //round($groupTimer/$examType->getGroupQuestions(),0, PHP_ROUND_HALF_UP));
        }
        elseif ($idType == 2)
        {
            $exam->setGroup(false);
            $exam->setArea(true);
            $exam->setTimer($groupTimer);
                  //  round($groupTimer/$examType->getAreaQuestions(),0, PHP_ROUND_HALF_UP));
        }
        else
        {
            $exam->setGroup(false);
            $exam->setArea(false);
            $exam->setTimer($examTimer);
        }


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
                ->findBy(array('proccessGroup' => $proccess, 'examType' => $examType ));
                $exam->setName($proccess->getName());
                $this->createExamQuestions($examType, $questions, $em, $exam);

            }
            else
            {
                $knowledge = $this->getDoctrine()
                ->getRepository('EntityBundle:KnowledgeArea')
                ->findOneById($idGroup);

                $questions = $this->getDoctrine()
                ->getRepository('EntityBundle:Question')
                ->findBy(array('knowledgeArea' => $knowledge, 'examType' => $examType ));
                $exam->setName($knowledge->getName());
                $this->createExamQuestions($examType, $questions, $em, $exam);

            }
        }
        else
        {
            if($examType->getSubGroup())
            {
                $proccess = $this->getDoctrine()
                ->getRepository('EntityBundle:ProccessGroup')
                ->findBy(array('examType' => $examType));
                 

                foreach ($proccess as $proc)
                {
                    $questions = $this->getDoctrine()
                    ->getRepository('EntityBundle:Question')
                    ->findBy(array('proccessGroup' => $proc));

                    $q2 = $this->rasndomizeArray($questions);
                    $numQuest = $this->totalQuestions($examType, $proc);
                    for ($x = 0; $x < $numQuest; $x++)
                    {
                        $result[] = $q2[$x];
                    }

                }
                $this->createExamQuestions($examType, $result, $em, $exam);
            }
            else
            {
                $questions = $this->getDoctrine()
                ->getRepository('EntityBundle:Question')
                ->findBy(array('examType' => $examType ));
                $this->createExamQuestions($examType, $questions, $em, $exam);
            
            }
        }
        return $exam;
    }
    
   
    private function createExamQuestions($examType, $questions, $em, $exam )
    {
        $now = new \DateTime();
        $result = $this->rasndomizeArray($questions);
        $questionsNumber =0;
        $groupQ = $exam->getGroup();
        $areaQ = $exam->getArea();
        if($groupQ)
        {
            $questionsNumber = $examType->getGroupQuestions();
            
        }
        elseif($areaQ)
        {
            $questionsNumber = $examType->getAreaQuestions();
        }
        else 
        {
            $questionsNumber = $examType->getTotalQuestions();
        }
        
        for ($x = 0; $x < $questionsNumber; $x++)
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
    
    
    
    private function getCharts($exam)
    {
        $graphics = array();
        $proccess = $this->getDoctrine()
            ->getRepository('EntityBundle:ProccessGroup')
            ->findBy(array('examType' => $exam->getExamType()), array('id'=>'asc')); 
        $count = 1;
        foreach($proccess as $proc)
        {
            $graphics[] = $this->getChartMod($proc, $exam, 'proceso'.$count);
            
            
            $count++;
        }
        return $graphics;
    }
    
    private function getCharts2($exam)
    {
        $graphics = array();
        $areas = $this->getDoctrine()
            ->getRepository('EntityBundle:KnowledgeArea')
            ->findBy(array('examType' => $exam->getExamType()), array('id'=>'asc')); 
        $count = 1;
        foreach($areas as $area)
        {
            $em = $this->getDoctrine()->getManager();
            $query =   $em->createQuery(
                       'SELECT eq FROM EntityBundle:ExamQuestion eq '
                       . 'JOIN eq.question q '
                       . 'WHERE eq.exam = :exam AND q.knowledgeArea = :area'
                       )->setParameters(array(


                       'area'=> $area,
                       'exam' => $exam    
                    ));

            try {
                $questions =   $query->getResult();
            } catch (\Doctrine\ORM\NoResultException $e) {
                $questions = array();
            }
            
            
            $correct = 0;
            foreach($questions as $question)
            {
                if($question->getSolved() && $question->getAnswer()->getCorrect())
                {
                    $correct++;
                }
            }

            $total= sizeof($questions);

            $incorrect =  $total - $correct;

            if($total >0)
            {
            $percentage = ($correct/$total) *100;
            }
            else
            {
                $percentage = 'NA';
            }
            $data = array(
               // array('Correctas', $correct),
               // array('Incorrectas', $incorrect),
               'Correctas' => $correct,
               'Incorrectas' => $incorrect,
               'Title'=> $area->getName(),
               'Porcentaje' => $percentage,
                'Total' => $total
            );
            $graphics[] = $data;
            
            
            $count++;
        }
        return $graphics;
    }
    
    
    private function getChartMod($proccess, $exam, $idContainer){
        
        
        $em = $this->getDoctrine()->getManager();
        $query =   $em->createQuery(
                   'SELECT eq FROM EntityBundle:ExamQuestion eq '
                   . 'JOIN eq.question q '
                   . 'WHERE eq.exam = :exam AND q.proccessGroup = :proccessGroup'
                   )->setParameters(array(
                       
                       
                   'proccessGroup'=> $proccess,
                   'exam' => $exam    
                ));
           
        try {
            $questions =   $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            $questions = array();
        }
                   
                   
        

        
        $correct = 0;
        foreach($questions as $question)
        {
            if($question->getSolved() && $question->getAnswer()->getCorrect())
            {
                $correct++;
            }
        }
        
        $total= sizeof($questions);
        
        $incorrect =  $total - $correct;
        
        if($total >0)
        {
        $percentage = ($correct/$total) *100;
        }
        else
        {
            $percentage = 'NA';
        }
        $data = array(
           // array('Correctas', $correct),
           // array('Incorrectas', $incorrect),
           'Correctas' => $correct,
           'Incorrectas' => $incorrect,
           'Title'=> $proccess->getName(),
           'Porcentaje' => $percentage,
            'Total' => $total
        );
        
        $ob = new Highchart();
        $ob->chart->renderTo($idContainer);
        $ob->chart->height('210');
        $ob->credits->enabled(FALSE);
        $ob->title->text($proccess->getName());
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $ob->series(array(array(
                    'type' => 'pie',
                    'name' => $proccess->getName(), 
                    'data' => $data,
                    'colorByPoint' => true,
                    'colors' => array(
                        '#85c558',
                        '#EE382A'),
                    )));
        return $data;
    }
}
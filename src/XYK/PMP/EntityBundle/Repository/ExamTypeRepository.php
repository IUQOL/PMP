<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExamTypeRepository
 *
 * @author iuqol
 */

namespace XYK\PMP\EntityBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ExamTypeRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy(array(), array('id' => 'ASC'));
    }
    
    public function findAllById($idExamType)
   {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id', $idExamType)
            ->orderBy('p.id', 'ASC')
            ->getQuery();

        return $qb->execute();

        // to get just one result:
        // $product = $qb->setMaxResults(1)->getOneOrNullResult();
    }
}


 
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XYK\PMP\EntityBundle\Repository;
use Doctrine\ORM\EntityRepository;
/**
 * Description of KnowledgeAreaRepository
 *
 * @author iuqol
 */


class KnowledgeAreaRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy(array(), array('id' => 'ASC'));
    }
}

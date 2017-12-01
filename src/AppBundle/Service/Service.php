<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

class Service
{
    protected $oEntityMgr;

    public function __construct(EntityManager $oEntityManager)
    {
        $this->oEntityMgr = $oEntityManager;
    }

    public function persistAndFlush($data)
    {
        $this->oEntityMgr->persist($data);
        $this->oEntityMgr->flush();
    }

    public function removeAndFlush($data)
    {
        $this->oEntityMgr->remove($data);
        $this->oEntityMgr->flush();
    }
}
<?php

namespace AppBundle\Service;

use AppBundle\Entity\Article;
use AppBundle\Entity\User;
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

    public function addLikeWishView($choice, User $user, $article)
    {
        if ($choice == "like")
        {
            $user->addArticleLike($article);
            $this->oEntityMgr->flush();
        }
        elseif ($choice == "wish")
        {
            $user->addArticleWish($article);
            $this->oEntityMgr->flush();
        }
        elseif ($choice == "view")
        {
            $user->addArticleWatched($article);
            $this->oEntityMgr->flush();
        }
    }

    public function removeLikeWishView($choice, User $user, $article)
    {
        if ($choice == "like")
        {
            $user->removeArticleLike($article);
            $this->oEntityMgr->flush();
        }
        elseif ($choice == "wish")
        {
            $user->removeArticleWish($article);
            $this->oEntityMgr->flush();
        }
        elseif ($choice == "view")
        {
            $user->removeArticleWatched($article);
            $this->oEntityMgr->flush();
        }
    }
}
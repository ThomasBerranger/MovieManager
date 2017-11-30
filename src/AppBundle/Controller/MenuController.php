<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        $articleDateArticle = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                array(),
                array('articleDate' => 'desc'),
                8
            );

        $articlePopular = $this->getDoctrine()
            ->getRepository(Article::class)
            ->mostPopular();

        $recentComments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findBy(
                array(),
                array('createdAt' => 'desc'),
                5
            );

        $allArticle = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        shuffle($allArticle);

        return $this->render('menu/index.html.twig', array("articleDateArticle" => $articleDateArticle, "articlePopular" => $articlePopular, "recentComments" => $recentComments, "allArticle" => $allArticle));
    }

    /**
     * @Route("/perso", name="perso")
     */
    public function persoAction(Request $request)
    {
        $articleDate = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                array(),
                array('date' => 'desc'),
                4
            );

        $articleDateArticle = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                array(),
                array('articleDate' => 'desc'),
                4
            );

        return $this->render('menu/perso.html.twig', array("articleDate" => $articleDate, "articleDateArticle" => $articleDateArticle));
    }


    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction(Request $request)
    {
        return $this->render('menu/admin.html.twig');
    }


}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use AppBundle\Entity\Comment;
use AppBundle\Entity\User;
use AppBundle\Form\ArticleEditType;
use AppBundle\Form\ArticleType;
use AppBundle\Form\CommentType;
use AppBundle\Service\Service;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Thomas\TagBundle\Form\DataTransformer\TagsTransformer;
use Thomas\TagBundle\Form\Type\TagsType;

class ArticleController extends Controller
{
    /**
     * @Route("/admin/article_add", name="article_add")
     */
    public function articleAddAction(Request $request, Service $service)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $article = $form->getData();

            $user = $this->getUser();
            $article->setUser($user);

            $cover = $article->getCover();
            if ( $cover )
            {
                $coverName = md5(uniqid()).'.'.$cover->guessExtension();
                $cover->move(
                    $this->getParameter('covers_directory'),
                    $coverName
                );
                $article->setCover($coverName);
            }

            $service->persistAndFlush($article);

            return $this->redirectToRoute('article_list');
        }

        return $this->render('articles/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/article_list", name="article_list")
     */
    public function articleListAction(Request $request)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                array(),
                array('date' => 'desc')
            );

        $articleRecent = $this->getDoctrine()
            ->getRepository(Article::class)
            ->recentArticle();

        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        $form = $this->createFormBuilder($article)
            ->add('name', SearchType::class, array(
                'attr' => array('class' => 'light-blue lighten-5')
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $data = $form->getData();

            return $this->redirectToRoute('article_search', array("search"=>$data['name']));
        }


        return $this->render('articles/list.html.twig', array(
            "article" => $article,
            "articleRecent" => $articleRecent,
            "category" => $category,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/article_list/{categoryId}", name="article_list_category")
     */
    public function articleListCategoryAction(Request $request, $categoryId)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findBy(
            array('category' => $categoryId),
            array('date' => 'desc')
        );

        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        $categorySelected = $this->getDoctrine()
            ->getRepository(Category::class)
            ->find($categoryId);

        $articleRecent = $this->getDoctrine()
            ->getRepository(Article::class)
            ->recentArticle();

        $form = $this->createFormBuilder($article)
            ->add('name', SearchType::class)
            ->getForm();

        $form->handleRequest($request);


        if ($form->isSubmitted())
        {
            $data = $form->getData();

            return $this->redirectToRoute('article_search', array("search"=>$data['name']));
        }

        return $this->render('articles/list.html.twig', array(
            "article" => $article,
            "articleRecent" => $articleRecent,
            "category" => $category,
            "categorySelected" => $categorySelected,
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/admin/article_edit/{id}", name="article_edit")
     */
    public function articleEditAction(Request $request, $id, Service $service)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        $form = $this->createForm(ArticleEditType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() /*&& $form->isValid()*/) {

            $article = $form->getData();

            $article->setArticleUpdate(new \DateTime());

            $service->persistAndFlush($article);

            $name = $article->getName();

            return $this->redirectToRoute('article_search', array(
                "search" => $name,
            ));
        }

        return $this->render('articles/edit.html.twig', array("article" => $article, 'form' => $form->createView(),));
    }

    /**
     * @Route("/admin/article_delete/{id}", name="article_delete")
     */
    public function userDeleteAction($id, Service $service)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

            $service->removeAndFlush($article);

            return $this->redirectToRoute('article_list');
        }

        throw $this->createNotFoundException(
            'You are not an administrator !'
        );
    }

    /**
     * @Route("/article/{search}", name="article_search")
     */
    public function articleSearchAction(Request $request, $search, Service $service)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(
                array('name' => $search)
            );

        $commentForm = new Comment();
        $form = $this->createForm(CommentType::class, $commentForm);
        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid() && $user->getMute() == false) {

            $commentForm = $form->getData();

            $commentForm->setUser($user);

            $commentForm->setArticle($article);

            $service->persistAndFlush($commentForm);

            $form = $this->createForm(CommentType::class);

            return $this->render('articles/article.html.twig', array(
                "article" => $article,
                'form' => $form->createView()
            ));
        }

        return $this->render('articles/article.html.twig', array(
            "article" => $article,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/comment/delete/{search}/{id}", name="comment_delete")
     */
    public function commentDeleteAction(Request $request, $search, $id, Service $service)
    {
        $comment = $this->getDoctrine()->getRepository(Comment::class)->find($id);

        $userComment = $comment->getUser();

        if ($this->getUser() == $userComment || $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $service->removeAndFlush($comment);
        }

        return $this->redirectToRoute('article_search', array('search' => $search));
    }

}

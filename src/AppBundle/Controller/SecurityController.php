<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Admin;
use AppBundle\Entity\Article;
use AppBundle\Service\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }


    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, Service $service)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $picture = $user->getPicture();
            if ( $picture )
            {
                $pictureName = md5(uniqid()).'.'.$picture->guessExtension();
                $picture->move(
                    $this->getParameter('pictures_directory'),
                    $pictureName
                );
                $user->setPicture($pictureName);
            }


            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $service->persistAndFlush($user);

            return $this->redirectToRoute('home');
        }

        return $this->render(
            'security/register.html.twig',
            array('form' => $form->createView())
        );
    }


    /**
     * @Route("/user_show/{id}", name="user_show")
     */
    public function userShowAction($id)
    {
        if ($this->getUser()->getId() == $id || $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->find($id);

            return $this->render("user/show.html.twig", array('user'=>$user));
        }

        throw $this->createNotFoundException(
            'Your id isn\'t '.$id
        );
    }

    /**
     * @Route("/admin/user_list", name="user_list")
     */
    public function userListAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findAll();

            return $this->render("user/list.html.twig", array('user'=>$user));
        }

        throw $this->createNotFoundException(
            'You are not an administrator !'
        );
    }


    /**
     * @Route("/user_edit/{id}", name="user_edit")
     */
    public function userEditAction(Request $request, $id, Service $service)
    {
        if ($this->getUser()->getId() == $id || $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            $user = $this->getDoctrine()->getRepository(User::class)->find($id);

            $form = $this->createFormBuilder($user)
                ->add('username', TextType::class)
                ->add('email', EmailType::class)
                ->add('Save', SubmitType::class, array(
                    'label' => 'Edit',
                    'attr' => array('class'=>"btn waves-effect waves-light light-green")
                ))
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() /*&& $form->isValid()*/)
            {
                $user = $form->getData();

                $updatedAt = new \DateTime();
                $user->setUpdatedAt($updatedAt);

                $service->persistAndFlush($user);

                return $this->redirectToRoute('home');
            }

            return $this->render('user/edit.html.twig',array(
                'form' => $form->createView()
            ));
        }

        throw $this->createNotFoundException(
            'Your id isn\'t '.$id
        );
    }


    /**
     * @Route("/admin/user_delete/{id}", name="user_delete")
     */
    public function userDeleteAction($id, Service $service)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            $user = $this->getDoctrine()->getRepository(User::class)->find($id);

            $service->removeAndFlush($user);

            return $this->redirectToRoute('user_list');
        }

        throw $this->createNotFoundException(
            'You are not an administrator !'
        );
    }


    /**
     * @Route("/user/likeAdd/{id}", name="user_like_add")
     */
    public function articleLikeAddAction(Request $request, $id)
    {
        $userId = $this->getUser()->getId();
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $user->addArticleLike($article);

        $em->flush();

        return $this->redirectToRoute('perso');
    }

    /**
     * @Route("/user/likeDelete/{id}", name="user_like_delete")
     */
    public function articleLikeDeleteAction(Request $request, $id)
    {
        $userId = $this->getUser()->getId();
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $user->removeArticleLike($article);

        $em->flush();

        return $this->redirectToRoute('perso');
    }

    /**
     * @Route("/user/wishAdd/{id}", name="user_wish_add")
     */
    public function articleWishAddAction(Request $request, $id)
    {
        $userId = $this->getUser()->getId();
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $user->addArticleWish($article);

        $em->flush();

        return $this->redirectToRoute('perso');
    }

    /**
     * @Route("/user/wishDelete/{id}", name="user_wish_delete")
     */
    public function articleWishDeleteAction(Request $request, $id)
    {
        $userId = $this->getUser()->getId();
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $user->removeArticleWish($article);

        $em->flush();

        return $this->redirectToRoute('perso');
    }

    /**
     * @Route("/user/watchedAdd/{id}", name="user_watched_add")
     */
    public function articleWatchedAddAction(Request $request, $id)
    {
        $userId = $this->getUser()->getId();
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $user->addArticleWatched($article);

        $em->flush();

        return $this->redirectToRoute('article_list');
    }

    /**
     * @Route("/user/watchedDelete/{id}", name="user_watched_delete")
     */
    public function articleWatchedDeleteAction(Request $request, $id)
    {
        $userId = $this->getUser()->getId();
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $user->removeArticleWatched($article);

        $em->flush();

        return $this->redirectToRoute('article_list');
    }


    /**
     * @Route("/admin/user_stop_mute/{id}", name="user_stop_mute")
     */
    public function userMuteAction(Request $request, $id, Service $service)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            $user = $this->getDoctrine()->getRepository(User::class)->find($id);

            $user->setMute(false);

            $service->persistAndFlush($user);

            return $this->redirectToRoute('user_show', array('id' => $id));
        }
        throw $this->createNotFoundException(
            'You are not an administrator !'
        );
    }


    /**
     * @Route("/admin/user_mute/{id}", name="user_mute")
     */
    public function userStopMuteAction(Request $request, $id, Service $service)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            $user = $this->getDoctrine()->getRepository(User::class)->find($id);

            $user->setMute(true);

            $service->persistAndFlush($user);

            return $this->redirectToRoute('user_show', array('id' => $id));
        }
        throw $this->createNotFoundException(
            'You are not an administrator !'
        );
    }
}

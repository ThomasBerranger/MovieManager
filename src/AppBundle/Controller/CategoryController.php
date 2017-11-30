<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategoryController extends Controller
{
    /**
     * @Route("/user/likeCategoryAdd/{id}", name="user_like_category_add")
     */
    public function categoryLikeAddAction(Request $request, $id)
    {
        $userId = $this->getUser()->getId();
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $user->addCategoryLike($category);

        $em->flush();

        return $this->redirectToRoute('article_list_category', array('categoryId'=> $id));
    }

    /**
     * @Route("/user/likeCategoryDelete/{id}", name="user_like_category_remove")
     */
    public function categoryLikeDeleteAction(Request $request, $id)
    {
        $userId = $this->getUser()->getId();
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $user->removeCategoryLike($category);

        $em->flush();

        return $this->redirectToRoute('article_list_category', array('categoryId'=> $id));
    }
}

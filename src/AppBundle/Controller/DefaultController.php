<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/prices", name="prices")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function prices(Request $request)
    {

        return $this->render('default/prices.html.twig');
    }

    /**
     * @Route("/blog", name="blog")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function blog(Request $request)
    {
        $articles = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->findBy([], ['dateAdded' => 'desc', 'viewCount' => 'desc']);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(

            $articles, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('article/blog.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @Route("/blog/{id}", name="blog_category")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function blogCategory(Request $request, $id)
    {
        $articles = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->findByCategory($id);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(

            $articles, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('article/blog.html.twig', ['pagination' => $pagination]);
    }

}

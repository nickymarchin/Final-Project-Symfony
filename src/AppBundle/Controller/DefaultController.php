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
     * @Route("/blog", name="blog")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function blog()
    {
        $articles = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->findBy([], ['dateAdded' => 'desc', 'viewCount' => 'desc']);


        return $this->render('article/blog.html.twig', ['articles' => $articles]);
    }
}

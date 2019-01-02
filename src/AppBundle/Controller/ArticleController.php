<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Article;
use AppBundle\Entity\User;
use AppBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{

    /**
     * @param Request $request
     *
     * @Route("/blog/article/create", name="article_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     *
     */
    public function create(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get('image')->getData();
            $fileName = null;
            if ($file) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            }

            try {

                if ($file) {
                    $file->move($this->getParameter('article_directory'), $fileName);
                }

            } catch (FileException $ex) {

            }

            $article->setImage($fileName);
            $currentUser = $this->getUser();
            $article->setAuthor($currentUser);
            $article->setViewCount(0);
            $article->setLikesCount(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute("blog");
        }

        return $this->render('article/create.html.twig',
            array('form' => $form->createView()));
    }

    /**
     * @Route("/blog/article/{id}", name="article_view")
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewArticle($id)
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);

        $article = $repository->find($id);

        $article->setViewCount($article->getViewCount() + 1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return $this->render('article/article.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/blog/article/edit/{id}", name="article_edit")
     *
     * @param $id
     * @param Request $request
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editArticle(int $id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);

        $article = $repository->find($id);

        if ($article === null) {
            return $this->redirectToRoute("blog");
        }

        $currentUser = $this->getUser();

        if (!$currentUser->isAuthor($article) && !$currentUser->isAdmin()) {
            return $this->redirectToRoute("blog");
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $file */
            $file = $form->get('image')->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            try {

                $file->move($this->getParameter('article_directory'), $fileName);

            } catch (FileException $ex) {

            }

            $article->setImage($fileName);

            $em = $this->getDoctrine()->getManager();

            $article->setDateAdded(new \DateTime('now'));

            $em->merge($article);
            $em->flush();

            return $this->redirectToRoute('blog');
        }

        return $this->render('article/edit.html.twig',
            [
                'article' => $article,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/blog/article/delete/{id}", name="article_delete")
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteArticle($id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);

        $article = $repository->find($id);

        if ($article === null) {
            return $this->redirectToRoute("blog");
        }

        $currentUser = $this->getUser();

        if (!$currentUser->isAuthor($article) && !$currentUser->isAdmin()) {
            return $this->redirectToRoute("blog");
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->remove($article);
            $em->flush();

            return $this->redirectToRoute('blog');
        }

        return $this->render('article/delete.html.twig',
            [
                'article' => $article,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/blog/article/like/{id}", name="article_like")
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function likes($id)
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);

        $article = $repository->find($id);

        if ($article === null) {
            return $this->redirectToRoute("blog");
        }

        /** @var User $currentUser */
        $currentUser = $this->getUser();

        $article->addUserLiked($currentUser);


        $em = $this->getDoctrine()->getManager();
        $em->merge($article);

        if (in_array($article->getId(), $currentUser->getLikedArticles())) {
            $this->addFlash('error', "You already liked this article!");

            return $this->render('article/article.html.twig',
                [
                    'article' => $article,
                ]);
        }

        $article->setLikesCount($article->getLikesCount() + 1);
        $currentUser->addLike($article);

        $em->flush();

        $this->addFlash('success', "Liked :)");

        return $this->render('article/article.html.twig',
            [
                'article' => $article,
            ]);
    }
}

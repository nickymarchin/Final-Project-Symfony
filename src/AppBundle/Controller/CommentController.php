<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;
use AppBundle\Entity\User;
use AppBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    /**
     *
     * @Route("/blog/article/{id}/comment", name="add_comment")
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addComment(Request $request, $id)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        $user = $this->getUser();

        $author = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->find($user->getId());

        $article = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        $comment->setAuthor($author);
        $comment->setArticle($article);

        $author->addComment($comment);
        $article->addComment($comment);

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        return $this->redirectToRoute('article_view', ['id' => $article->getId()]);
    }
}



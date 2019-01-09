<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Driver;
use AppBundle\Entity\Rating;
use AppBundle\Form\RatingType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;
use AppBundle\Entity\User;
use AppBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RatingController extends Controller
{
    /**
     *
     * @Route("/driver/{id}/rate", name="add_rate")
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addRate(Request $request, $id)
    {
        $rating = new Rating();
        $form = $this->createForm(RatingType::class, $rating);
        $form->handleRequest($request);

        $user = $this->getUser();

        $author = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->find($user->getId());

        $driver = $this
            ->getDoctrine()
            ->getRepository(Driver::class)
            ->find($id);

        $rating->setAuthor($author);
        $rating->setDriver($driver);

        $author->addDriverRating($rating);

        $driver->addRating($rating);
        $driver->setRatingsCount($driver->getRatingsCount() + 1);
        $driver->setRatingsSum($driver->getRatingsSum() + $form->getData()->getGrade());

        $em = $this->getDoctrine()->getManager();
        $em->persist($rating);
        $em->flush();

        return $this->redirectToRoute('all_drivers');
    }
}




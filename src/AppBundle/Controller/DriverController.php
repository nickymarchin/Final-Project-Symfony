<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Driver;
use AppBundle\Form\DriverType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DriverController extends Controller
{
    /**
     * @Route("/drivers", name="all_drivers")
     *
     * @return Response
     */
    public function drivers(){

        $drivers = $this
            ->getDoctrine()
            ->getRepository(Driver::class)
            ->findBy([]);

        return $this->render('driver/drivers.html.twig', ['drivers' => $drivers]);

    }

    /**
     * @Route("/driver/profile", name="driver_profile")
     *
     * @return Response
     */
    public function driverProfile(){

        return $this->render('driver/profile.html.twig');

    }

    /**
     * @param Request $request
     *
     * @Route("/driver/create", name="driver_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Security("is_granted('ROLE_ADMIN')")
     *
     * @return Response
     *
     */
    public function create(Request $request)
    {
        $driver = new Driver();
        $form = $this->createForm(DriverType::class, $driver);

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

            $driver->setImage($fileName);
            $driver->setRatingsCount(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($driver);
            $em->flush();

            return $this->redirectToRoute("homepage");
        }

        return $this->render('driver/create.html.twig',
            array('form' => $form->createView()));
    }

    /**
     * @Route("/driver/edit/{id}", name="driver_edit")
     *
     * @param $id
     * @param Request $request
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Security("is_granted('ROLE_ADMIN')")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editDriver(int $id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Driver::class);

        $driver = $repository->find($id);

        if ($driver === null) {
            return $this->redirectToRoute("homepage");
        }

        $form = $this->createForm(DriverType::class, $driver);

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

            $driver->setImage($fileName);

            $em = $this->getDoctrine()->getManager();

            $em->merge($driver);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('driver/edit.html.twig',
            [
                'driver' => $driver,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/driver/delete/{id}", name="driver_delete")
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Security("is_granted('ROLE_ADMIN')")
     *
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteDriver($id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Driver::class);

        $driver = $repository->find($id);

        if ($driver === null) {
            return $this->redirectToRoute("homepage");
        }

        $form = $this->createForm(DriverType::class, $driver);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->remove($driver);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('driver/delete.html.twig',
            [
                'driver' => $driver,
                'form' => $form->createView()
            ]);
    }
}

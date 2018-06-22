<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return mixed
     * @Route("/", name="home")
     */

    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new Users();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request); //if the request ia a POST, process the submitted data

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $form->get('plainPassword')->getData());
         //   $password = $passwordEncoder->encodePassword($user, $user->getPassword());

            //$password = getPassword();
            $user->setPassword($password); #why do i need this function

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}


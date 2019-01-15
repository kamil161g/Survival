<?php


namespace App\Controller;


use App\Entity\Users;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    public function createNewUserAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $users = new Users();

        $form = $this->createForm(RegistrationType::class, $users);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $password = $passwordEncoder->encodePassword($users, $users->getPlainPassword());

                $this->getDoctrine()
                    ->getRepository(Users::class)
                    ->addUser($users, $password);

            }


        return $this->render("Registration/registration.html.twig",[
            'form' => $form->createView()
        ]);
    }
    
}
<?php


namespace App\Controller;


use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetCarbonController extends AbstractController
{
    public function getCarbonAction()
    {
        $user = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Carbon'
                ]);


        $valueAdd = rand(100*$user->getLevel(), 200*$user->getLevel());
        $value = $user->getValue()+$valueAdd;

        $this->getDoctrine()
            ->getRepository(Material::class)
            ->addCarbon($user, $value);


            return $this->redirectToRoute("viewMenu");
    }
    
    
}
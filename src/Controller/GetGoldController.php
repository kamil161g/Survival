<?php


namespace App\Controller;


use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetGoldController extends AbstractController
{
    public function getGoldAction()
    {
        $user = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Gold'
                ]);


        $valueAdd = rand(100*$user->getLevel(), 200*$user->getLevel());
        $value = $user->getValue()+$valueAdd;

        $this->getDoctrine()
            ->getRepository(Material::class)
            ->addGold($user, $value);


            return $this->redirectToRoute("viewMenu");
    }
    
    
}
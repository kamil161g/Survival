<?php


namespace App\Controller;


use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetStoneController extends AbstractController
{
    public function getStoneAction()
    {
        $user = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Stone'
                ]);


        $valueAdd = rand(100*$user->getLevel(), 200*$user->getLevel());
        $value = $user->getValue()+$valueAdd;

        $this->getDoctrine()
            ->getRepository(Material::class)
            ->addStone($user, $value);


            return $this->redirectToRoute("viewMenu");
    }
    
    
}
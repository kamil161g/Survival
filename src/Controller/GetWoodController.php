<?php


namespace App\Controller;


use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetWoodController extends AbstractController
{
    public function getWoodAction()
    {
        $user = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Wood'
                ]);


        $valueAdd = rand(100*$user->getLevel(), 200*$user->getLevel());
        $value = $user->getValue()+$valueAdd;

        $this->getDoctrine()
            ->getRepository(Material::class)
            ->addWood($user, $value);


            return $this->redirectToRoute("viewMenu");
    }
    
    
}
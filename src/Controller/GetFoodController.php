<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 12.01.19
 * Time: 23:10
 */

namespace App\Controller;


use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetFoodController extends AbstractController
{
    public function getFoodAction()
    {
        $user = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy(['user' => $this->getUser()]);


        $valueAdd = rand(100*$user->getLevel(), 200*$user->getLevel());
        $value = $user->getValue()+$valueAdd;

        $this->getDoctrine()
            ->getRepository(Material::class)
            ->addFood($user, $value);


            return $this->redirectToRoute("viewMenu");
    }
    
    
}
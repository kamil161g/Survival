<?php


namespace App\Controller;

use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewGoldController extends AbstractController
{
    public function getGoldAction()
    {

        $searchFood = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Gold'
                ]);

        $time = date('H:i:s', strtotime('+10 minutes'));


        return $this->render("Materials/Gold/getGold.html.twig",[
            'food_value' => $searchFood,
            'time' => $time
        ]);
    }

}
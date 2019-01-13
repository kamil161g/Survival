<?php


namespace App\Controller;

use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewFoodController extends AbstractController
{
    public function getFoodAction()
    {

        $searchFood = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Food'
                ]);

        $time = date('H:i:s', strtotime('+10 minutes'));


        return $this->render("Materials/Food/getFood.html.twig",[
            'food_value' => $searchFood,
            'time' => $time
        ]);
    }

}
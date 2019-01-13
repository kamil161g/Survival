<?php


namespace App\Controller;

use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewWoodController extends AbstractController
{
    public function getWoodAction()
    {

        $searchFood = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Wood'
                ]);

        $time = date('H:i:s', strtotime('+10 minutes'));


        return $this->render("Materials/Wood/getWood.html.twig",[
            'food_value' => $searchFood,
            'time' => $time
        ]);
    }

}
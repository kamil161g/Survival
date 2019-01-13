<?php


namespace App\Controller;

use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewStoneController extends AbstractController
{
    public function getStoneAction()
    {

        $searchFood = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Stone'
                ]);

        $time = date('H:i:s', strtotime('+10 minutes'));


        return $this->render("Materials/Stone/getStone.html.twig",[
            'food_value' => $searchFood,
            'time' => $time
        ]);
    }

}
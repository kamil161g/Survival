<?php


namespace App\Controller;

use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewCarbonController extends AbstractController
{
    public function getCarbonAction()
    {

        $searchFood = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Carbon'
                ]);

        $time = date('H:i:s', strtotime('+10 minutes'));


        return $this->render("Materials/Carbon/getCarbon.html.twig",[
            'food_value' => $searchFood,
            'time' => $time
        ]);
    }

}
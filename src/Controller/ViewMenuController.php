<?php

namespace App\Controller;


use App\Entity\Village;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewMenuController extends AbstractController
{
    public function viewMenuAction()
    {
        $checkVillage = $this->getDoctrine()
            ->getRepository(Village::class)
            ->findOneBy(['user' => $this->getUser()]);

        if($checkVillage){
            return $this->render("Menu/viewmenu.html.twig",[
                'village' => true
            ]);
        }else
            return $this->render("Menu/viewmenu.html.twig",[
                'village' => false
            ]);
    }
}
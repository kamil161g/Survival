<?php


namespace App\Controller;


use App\Entity\Village;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditVillageController extends AbstractController
{
    public function editVillageAction()
    {
        $village = $this->getDoctrine()
            ->getRepository(Village::class)
            ->findOneBy(['user' => $this->getUser()]);

        return $this->render("Village/editVillage.html.twig",[
            'village' => $village
        ]);

    }

}
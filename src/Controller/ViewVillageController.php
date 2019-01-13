<?php


namespace App\Controller;


use App\Entity\Material;
use App\Entity\Village;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewVillageController extends AbstractController
{
    public function viewVillageAction($id)
    {
        $village = $this->getDoctrine()
            ->getRepository(Village::class)
            ->findOneBy(['user' => $id]);

        $food = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $id,
                'category' => 'Food'
            ]);

        return $this->render("Village/villageProfil.html.twig",[
            'village' => $village,
            'food' => $food
        ]);
    }
}
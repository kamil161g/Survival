<?php


namespace App\Controller;


use App\Entity\Material;
use App\Entity\Stat;
use App\Entity\Village;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewVillageController extends AbstractController
{
    public function viewVillageAction($id)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');


        $village = $this->getDoctrine()
            ->getRepository(Village::class)
            ->findOneBy(['user' => $id]);

        $food = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $id,
                'category' => 'Food'
            ]);

        $stone = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $id,
                'category' => 'Stone'
            ]);

        $gold = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $id,
                'category' => 'Gold'
            ]);

        $wood = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $id,
                'category' => 'Wood'
            ]);

        $carbon = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $id,
                'category' => 'Carbon'
            ]);

        $valueAtttack = $this->getDoctrine()
            ->getRepository(Stat::class)
            ->findOneBy([
                'user' => $id,
                'category' => 'Attack'
            ]);


        $valueDefense = $this->getDoctrine()
            ->getRepository(Stat::class)
            ->findOneBy([
                'user' => $id,
                'category' => 'Defense'
            ]);

        return $this->render("Village/villageProfil.html.twig",[
            'village' => $village,
            'food' => $food,
            'stone' => $stone,
            'gold' => $gold,
            'wood' => $wood,
            'carbon' => $carbon,
            'valueMin' => $valueAtttack->getValueMin(),
            'valueMax' => $valueAtttack->getValueMax(),
            'valueDefense' => $valueDefense->getValueMax(),
        ]);
    }
}
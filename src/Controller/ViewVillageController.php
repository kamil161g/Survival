<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 12.01.19
 * Time: 10:33
 */

namespace App\Controller;


use App\Entity\Village;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewVillageController extends AbstractController
{
    public function viewVillageAction()
    {
        $village = $this->getDoctrine()
            ->getRepository(Village::class)
            ->findOneBy(['user' => $this->getUser()]);

        return $this->render("Village/villageProfil.html.twig",[
            'village' => $village
        ]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 16.01.19
 * Time: 22:55
 */

namespace App\Controller;


use App\Entity\Build;
use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AddCastleController extends AbstractController
{

    public function addCastleAction()
    {
        return $this->render("Village/Castle/addCastle.html.twig");
    }

    public function addFinishCastleAction($population, Request $request)
    {
        $category = "Castle";

        $checkFood = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Food'
            ]);

        $checkStone = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Stone'
            ]);

        $checkWood = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Wood'
            ]);

        $build = $this->getDoctrine()
            ->getRepository(Build::class)
            ->findOneBy([
                'category' => "Castle",
                'user' => $this->getUser(),
            ]);

        if(!$build)
            $build = new Build();

        switch ($population)
        {
            case 10:
                if($checkFood->getValue() >= 1000 &&
                    $checkStone->getValue() >= 1000 &&
                    $checkWood->getValue() > 1000){

                    $add = $this->getDoctrine()
                        ->getRepository(Build::class)
                        ->addHouse($build, $population, $this->getUser(), $category);


                    $this->addFlash("success",
                        "Brawo twoja armia urosła o 10 ludzi.");
                }else
                    $this->addFlash("error", "Masz za mało surowców.");

                break;

            case 50:
                if($checkFood->getValue() >= 5000 &&
                    $checkStone->getValue() >= 5000 &&
                    $checkWood->getValue() >= 5000){

                    $add = $this->getDoctrine()
                        ->getRepository(Build::class)
                        ->addHouse($build, $population, $this->getUser(), $category);

                    $this->addFlash("success",
                        "Brawo twoja armia urosła o 50 ludzi.");
                }else
                    $this->addFlash("error", "Masz za mało surowców.");

                break;

            case 100:
                if($checkFood->getValue() >= 10000 &&
                    $checkStone->getValue() >= 10000 &&
                    $checkWood->getValue() >= 10000){

                    $add = $this->getDoctrine()
                        ->getRepository(Build::class)
                        ->addHouse($build, $population, $this->getUser(), $category);

                    $this->addFlash("success",
                        "Brawo twoja armia urosła o 100 ludzi.");
                }else
                    $this->addFlash("error", "Masz za mało surowców.");

                break;
        }



        return $this->redirect($request->headers->get('referer'));

        return 0;
    }
}
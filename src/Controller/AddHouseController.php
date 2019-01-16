<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 15.01.19
 * Time: 22:04
 */

namespace App\Controller;


use App\Entity\Build;
use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AddHouseController extends AbstractController
{
    public function addHouseAction()
    {

        return $this->render("Village/House/addHouse.html.twig");
    }

    public function addHouseFinishAction($population, Request $request)
    {
        $category = "House";

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
                'category' => "House",
                'user' => $this->getUser(),
            ]);

        if(!$build)
            $build = new Build();

        switch ($population)
        {
            case 100:
                if($checkFood->getValue() >= 1000 &&
                   $checkStone->getValue() >= 1000 &&
                   $checkWood->getValue() > 1000){

                    $add = $this->getDoctrine()
                        ->getRepository(Build::class)
                        ->addHouse($build, $population, $this->getUser(), $category);


                    $this->addFlash("success",
                        "Brawo zbudowałeś dom o pojemności 100 ludzi.");
                }else
                    $this->addFlash("error", "Masz za mało surowców.");

            break;

            case 700:
                if($checkFood->getValue() >= 5000 &&
                    $checkStone->getValue() >= 5000 &&
                    $checkWood->getValue() >= 5000){

                    $add = $this->getDoctrine()
                        ->getRepository(Build::class)
                        ->addHouse($build, $population, $this->getUser(), $category);

                    $this->addFlash("success",
                        "Brawo zbudowałeś dom o pojemności 700 ludzi.");
                }else
                    $this->addFlash("error", "Masz za mało surowców.");

                break;

            case 1000:
                if($checkFood->getValue() >= 10000 &&
                    $checkStone->getValue() >= 10000 &&
                    $checkWood->getValue() >= 10000){

                    $add = $this->getDoctrine()
                        ->getRepository(Build::class)
                        ->addHouse($build, $population, $this->getUser(), $category);

                    $this->addFlash("success",
                        "Brawo zbudowałeś dom o pojemności 1000 ludzi.");
                }else
                    $this->addFlash("error", "Masz za mało surowców.");

                break;
        }



        return $this->redirect($request->headers->get('referer'));

    }
}
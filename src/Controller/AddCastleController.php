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
use App\Entity\Stat;
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

        $a = false;
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

        $valueMin = $population*2;
        $valueMax = $population*3;

        switch ($population)
        {
            case 10:
                if($checkFood->getValue() >= 1000 &&
                    $checkStone->getValue() >= 1000 &&
                    $checkWood->getValue() > 1000){

                    $a = true;
                    $required = 1000;

                    $this->getDoctrine()
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

                    $a = true;
                    $required = 5000;

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

                    $a = true;
                    $required = 10000;

                    $add = $this->getDoctrine()
                        ->getRepository(Build::class)
                        ->addHouse($build, $population, $this->getUser(), $category);

                    $this->addFlash("success",
                        "Brawo twoja armia urosła o 100 ludzi.");
                }else
                    $this->addFlash("error", "Masz za mało surowców.");

                break;
        }

        if($a){
            $value = $this->getDoctrine()
                ->getRepository(Stat::class)
                ->findOneBy([
                    'user' => $this->getUser(),
                    'category' => 'Attack'
                ]);

            $gold = $this->getDoctrine()
                ->getRepository(Material::class)
                ->findOneBy([
                    'user' => $this->getUser(),
                    'category' => 'Gold'
                ]);

            $food = $this->getDoctrine()
                ->getRepository(Material::class)
                ->findOneBy([
                    'user' => $this->getUser(),
                    'category' => 'Food'
                ]);

            $wood = $this->getDoctrine()
                ->getRepository(Material::class)
                ->findOneBy([
                    'user' => $this->getUser(),
                    'category' => 'Wood'
                ]);

            $valueMin = $value->getValueMin() + $value->getValueMin()*0.2;
            $valueMax = $value->getValueMax() + $value->getValueMax()*0.2;


            $this->getDoctrine()
                ->getRepository(Stat::class)
                ->addPoints($valueMin, $valueMax, $value);

            $this->getDoctrine()
                ->getRepository(Material::class)
                ->removeGold($gold, $required);

            $this->getDoctrine()
                ->getRepository(Material::class)
                ->removeWood($wood, $required);

            $this->getDoctrine()
                ->getRepository(Material::class)
                ->removeFood($food, $required);
        }


        return $this->redirect($request->headers->get('referer'));

    }
}
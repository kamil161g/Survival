<?php


namespace App\Controller;


use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddLevelCarbonController extends AbstractController
{
    public function addLevelCarbonAction()
    {
        $carbon = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Carbon'
            ]);

        $gold = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Gold'
            ]);

        $wood = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Wood'
            ]);

        $food = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Food'
            ]);


        $stone = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Stone'
            ]);

            $needs = $stone->getLevel() + 999;


                if($stone->getValue() &&
                    $gold->getValue() &&
                    $wood->getValue() &&
                    $food->getValue() >= $needs){

                        $this->getDoctrine()
                            ->getRepository(Material::class)
                            ->addLevel($carbon);

                        $this->addFlash("success","Zwiększyłeś poziom o 1.");
                }else{
                        $this->addFlash("error","Masz za mało materiałów.");

                }

        return $this->render("Materials/Food/addedFoodLevel.html.twig");
    }
}
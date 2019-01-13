<?php


namespace App\Controller;


use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddLevelFoodController extends AbstractController
{
    public function addLevelFoodAction()
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

        $stone = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Stone'
            ]);


        $food = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Food'
            ]);

            $needs = $food->getLevel() + 999;


                if($carbon->getValue() &&
                    $gold->getValue() &&
                    $wood->getValue() &&
                    $stone->getValue() >= $needs){

                        $this->getDoctrine()
                            ->getRepository(Material::class)
                            ->addLevel($food);

                        $this->addFlash("success","Zwiększyłeś poziom o 1.");
                }else{
                        $this->addFlash("error","Masz za mało materiałów.");

                }

        return $this->render("Materials/Food/addedFoodLevel.html.twig");
    }
}
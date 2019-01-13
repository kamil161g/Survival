<?php


namespace App\Controller;


use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddLevelWoodController extends AbstractController
{
    public function addLevelWoodAction()
    {
        $carbon = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Carbon'
            ]);

        $stone = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Stone'
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


        $gold = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Gold'
            ]);

            $needs = $gold->getLevel() + 999;


                if($stone->getValue() &&
                    $gold->getValue() &&
                    $carbon->getValue() &&
                    $food->getValue() >= $needs){

                        $this->getDoctrine()
                            ->getRepository(Material::class)
                            ->addLevel($wood);

                        $this->addFlash("success","Zwiększyłeś poziom o 1.");
                }else{
                        $this->addFlash("error","Masz za mało materiałów.");

                }

        return $this->render("Materials/Food/addedFoodLevel.html.twig");
    }
}
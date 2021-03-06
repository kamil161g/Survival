<?php


namespace App\Controller;

use App\Entity\Material;
use App\Entity\StatusMission;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewWoodController extends AbstractController
{
    public function getWoodAction()
    {

        $searchFood = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Wood'
                ]);

        $time = date('H:i:s', strtotime('+10 minutes'));


        $statusMission = $this->getDoctrine()
            ->getRepository(StatusMission::class)
            ->findOneBy([
                'user' => $this->getUser(),
            ]);

        if($statusMission == null){
            $status = null;

            return $this->render("Materials/Wood/getWood.html.twig",[
                'food_value' => $searchFood,
                'time' => $time,
                'status' => $status
            ]);
        }else{
            $timeFinish = $statusMission->getFinishTime();
            return $this->render("Materials/Wood/getWood.html.twig",[
                'food_value' => $searchFood,
                'time' => $time,
                'timeFinish' => $timeFinish,
                'status' => $statusMission
            ]);
        }
    }

}
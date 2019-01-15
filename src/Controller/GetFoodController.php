<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 12.01.19
 * Time: 23:10
 */

namespace App\Controller;


use App\Entity\Material;
use App\Entity\StatusMission;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetFoodController extends AbstractController
{
    public function getFoodAction(Request $request)
    {

        $time = date('Y-m-d H:i:s');

        $statusMission = $this->getDoctrine()
                              ->getRepository(StatusMission::class)
                              ->findOneBy(['user' => $this->getUser()]);

        if($statusMission->getFinishTime()->getTimestamp() < time()){
            $user = $this->getDoctrine()
                ->getRepository(Material::class)
                ->findOneBy([
                    'user' => $this->getUser(),
                    'category' => 'Food'
                    ]);

            $this->getDoctrine()
                 ->getRepository(StatusMission::class)
                 ->removeStatus($statusMission);


            $valueAdd = rand(100*$user->getLevel(), 200*$user->getLevel());
            $value = $user->getValue()+$valueAdd;

            $this->getDoctrine()
                ->getRepository(Material::class)
                ->addFood($user, $value);

            $this->addFlash("success", "Zdobyłeś ".$value." jedzenia.");

            return $this->redirect($request->headers->get('referer'));
        }else{
            $this->addFlash("error", "Nie ukończyłeś jeszcze misji.");
            return $this->redirect($request->headers->get('referer'));
        }


    }
    
    
}
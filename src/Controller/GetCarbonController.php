<?php


namespace App\Controller;


use App\Entity\Material;
use App\Entity\StatusMission;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetCarbonController extends AbstractController
{
    public function getCarbonAction(Request $request)
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
                    'category' => 'Carbon'
                ]);

            $this->getDoctrine()
                ->getRepository(StatusMission::class)
                ->removeStatus($statusMission);


            $valueAdd = rand(100*$user->getLevel(), 200*$user->getLevel());
            $value = $user->getValue()+$valueAdd;

            $this->getDoctrine()
                ->getRepository(Material::class)
                ->addCarbon($user, $value);

            $this->addFlash("success", "Zdobyłeś ".$valueAdd." węgla.");

            return $this->redirect($request->headers->get('referer'));
        }else{
            $this->addFlash("error", "Nie ukończyłeś jeszcze misji.");
            return $this->redirect($request->headers->get('referer'));
        }
    }
    
    
}
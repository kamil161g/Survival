<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 14.01.19
 * Time: 20:41
 */

namespace App\Controller;


use App\Entity\StatusMission;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CheckStatusMissionController extends AbstractController
{
    public function checkStatusAction(Request $request)
    {
        $statusMission = new StatusMission();

            $this->getDoctrine()
                 ->getRepository(StatusMission::class)
                 ->addStatus($statusMission, $this->getUser());

//            return $this->redirectToRoute("myProfilVillage",[
//                'id' => $this->getUser()->getId(),
//            ]);
        return $this->redirect($request->headers->get('referer'));
    }
}
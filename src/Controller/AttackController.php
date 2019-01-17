<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 17.01.19
 * Time: 19:44
 */

namespace App\Controller;


use App\Entity\Material;
use App\Entity\Stat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AttackController extends AbstractController
{

    public function viewAttackAction()
    {
        $value = $this->getDoctrine()
            ->getRepository(Stat::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Attack'
            ]);

        $required = $value->getValueMax() + $value->getValueMax()*2;
        $valueMin = $value->getValueMin();
        $valueMax = $value->getValueMax();

        return $this->render("Stats/viewAttack.html.twig",[
            'required' => $required,
            'valueMin' => $valueMin,
            'valueMax' => $valueMax
        ]);
    }

    public function addPointsAttackAction(Request $request)
    {

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

        $carbon = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Carbon'
            ]);
        $required = $value->getValueMax() + $value->getValueMax()*2;
        $valueMin = $value->getValueMin() + $value->getValueMin()*0.2;
        $valueMax = $value->getValueMax() + $value->getValueMax()*0.2;

        if(
            $gold->getValue() > $valueMax &&
            $carbon->getValue() > $valueMax
        ){
            $this->getDoctrine()
                ->getRepository(Stat::class)
                ->addPoints($valueMin, $valueMax, $value);

            $this->getDoctrine()
                ->getRepository(Material::class)
                ->removeGold($gold, $required);

            $this->getDoctrine()
                ->getRepository(Material::class)
                ->removeCarbon($carbon, $required);

            $this->addFlash('success', "Zwiększyłeś atak.");
        }else
            $this->addFlash('error', "Masz za mało surowców.");


        return $this->redirect($request->headers->get('referer'));


    }

}
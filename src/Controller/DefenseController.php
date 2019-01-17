<?php


namespace App\Controller;


use App\Entity\Material;
use App\Entity\Stat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DefenseController extends AbstractController
{
    public function viewDefensekAction()
    {
        $value = $this->getDoctrine()
            ->getRepository(Stat::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Defense'
            ]);

        $required =  $value->getValueMax()*2;
        $value = $value->getValueMax();

        return $this->render("Stats/viewDefense.html.twig",[
            'required' => $required,
            'value' => $value
        ]);
    }

    public function addPointsDefenseAction(Request $request)
    {

        $value = $this->getDoctrine()
            ->getRepository(Stat::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'Defense'
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
        $required = $value->getValueMax() + $value->getValueMax()*3;
        $valueMax = $value->getValueMax() + $value->getValueMax()*0.2;

        if(
            $gold->getValue() > $valueMax &&
            $carbon->getValue() > $valueMax
        ){
            $this->getDoctrine()
                ->getRepository(Stat::class)
                ->addDefense($valueMax, $value);

            $this->getDoctrine()
                ->getRepository(Material::class)
                ->removeGold($gold, $required);

            $this->getDoctrine()
                ->getRepository(Material::class)
                ->removeCarbon($carbon, $required);

            $this->addFlash('success', "Zwiększyłeś obrone.");
        }else
            $this->addFlash('error', "Masz za mało surowców.");


        return $this->redirect($request->headers->get('referer'));


    }

}
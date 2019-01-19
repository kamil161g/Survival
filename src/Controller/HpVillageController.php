<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 19.01.19
 * Time: 09:57
 */

namespace App\Controller;


use App\Entity\Material;
use App\Entity\Stat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HpVillageController extends AbstractController
{
    public function viewHpAction()
    {
        $value = $this->getDoctrine()
            ->getRepository(Stat::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'HP'
            ]);

        $required =  $value->getValueMax();
        $value = $value->getValueMax();

        return $this->render("Stats/viewHP.html.twig",[
            'required' => $required,
            'value' => $value
        ]);
    }

    public function addPointsHpAction(Request $request)
    {

        $value = $this->getDoctrine()
            ->getRepository(Stat::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'category' => 'HP'
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
        $required = $value->getValueMax() + $value->getValueMax()*1.7;
        $valueMax = $value->getValueMax()*1.2;

        if(
            $food->getValue() > $required &&
            $wood->getValue() > $required
        ){
            $this->getDoctrine()
                ->getRepository(Stat::class)
                ->addDefense($valueMax, $value);

            $this->getDoctrine()
                ->getRepository(Material::class)
                ->removeFood($food, $required);

            $this->getDoctrine()
                ->getRepository(Material::class)
                ->removeWood($wood, $required);

            $this->addFlash('success', "Zwiększyłeś punkty życia.");
        }else
            $this->addFlash('error', "Masz za mało surowców.");


        return $this->redirect($request->headers->get('referer'));


    }
}
<?php


namespace App\Controller;


use App\Entity\Material;
use App\Entity\Village;
use App\Form\CreateNewVillageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CreateNewVillageController extends AbstractController
{
    public function createNewVillageAction(Request $request)
    {
        $village = new Village();


        $form = $this->createForm(CreateNewVillageType::class);

            $form->handleRequest($request);

            $checkVillage = $this->getDoctrine()
            ->getRepository(Village::class)
            ->findOneBy(['user' => $this->getUser()]);

                if($checkVillage){
                    return $this->redirectToRoute('index');
                }

                if($form->isSubmitted() && $form->isValid()){

                    $name = $form->get('name')->getViewData();

                    $this->getDoctrine()
                        ->getRepository(Village::class)
                        ->createNewVillage($village, $this->getUser(), $name);

                        $this->getDoctrine()
                             ->getRepository(Material::class)
                             ->createMaterial($this->getUser());

            }

        return $this->render("Village/createNewVillage.html.twig",[
            'form' => $form->createView()
        ]);
    }
}
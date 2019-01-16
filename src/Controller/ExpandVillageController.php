<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 15.01.19
 * Time: 20:27
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExpandVillageController extends AbstractController
{
    public function expandVillageAction()
    {

        return $this->render("Village/expandVillage.html.twig");
    }
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RecettesController extends AbstractController
{
    /**
     * @Route("/recettes", name="recettes")
     */
    public function index()
    {
        return $this->render('recettes/index.html.twig', [
            'controller_name' => 'RecettesController',
        ]);
    }
}

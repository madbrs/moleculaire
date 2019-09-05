<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */

    public function home()
    {
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/recipes", name="recipes")
     */

    public function recipes()
    {
        return $this->render('recipes/recipes.html.twig', [
            'controller_recipes' => 'RecipesController',
        ]);
    }

     /**
     * @Route("/ingredients", name="ingredients")
     */

    public function ingredients()
    {
        return $this->render('recipes/ingredients.html.twig', [
            'controller_ingredients' => 'IngredientsController',
        ]);
    }
}

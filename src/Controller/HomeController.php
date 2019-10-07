<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Step;
use App\Entity\Unit;
use App\Entity\Recipe;
use App\Entity\Reviews;
use App\Entity\Ingredient;
use App\Entity\CookingTools;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request, ObjectManager $manager)
    {
        
        $rec = $this->getDoctrine()->getRepository(Recipe::class);
        $cat = $this->getDoctrine()->getRepository(Tag::class);
        $ust = $this->getDoctrine()->getRepository(CookingTools::class);
        $ing = $this->getDoctrine()->getRepository(Ingredient::class);
        $stp = $this->getDoctrine()->getRepository(Step::class);
        $uni = $this->getDoctrine()->getRepository(Unit::class);

        // pour tout afficher et lister on utilise findAll
        $recipe = $rec->findAll();
        $tag = $cat->findAll();
        $cookingTools = $ust->findAll();
        $ingredient = $ing->findAll();
        $step = $stp->findAll();
        $unit = $uni->findAll();


return $this->render('home/home.html.twig', [

    'controller_name' => 'HomeController',
    'recipe' => $recipe,
    'tag' => $tag,
    'cookingTools' => $cookingTools,
    'ingredient' => $ingredient,
    'step' => $step,
    'unit' => $unit,
]);


    }
}
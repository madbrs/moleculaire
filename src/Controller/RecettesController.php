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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class RecettesController extends AbstractController
{

    /**
     * @Route("/recettes", name="recettes")
     */


        public function index(Request $request, ObjectManager $manager)
        {
            
            $rec = $this->getDoctrine()->getRepository(Recipe::class);

    
            // pour tout afficher et lister on utilise findAll
            $recipe = $rec->findAll();
         
    
    
    return $this->render('recettes/index.html.twig', [
    
        'controller_name' => 'RecettesController',
        'recipe' => $recipe,

    ]);
    
    }    
    /**
     * @Route("recettes/{id}", name="recettes_show")
     */
    public function show($id)
    {
        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->find($id);
    
        if (!$recipe) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }


    
        // return new Response('Check out this great product: '.$recipe->getTitle());
    
        // or render a template
        // in the template, print things with {{ product.name }}
        return $this->render('recettes/index.html.twig', ['recipe' => $recipe]);
       
    }

    }


<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Form\BeerType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BeerController extends AbstractController
{
    /**
     * @Route("/beer", name="beer")
     */
    public function index()
    {
        return $this->render('beer/index.html.twig', [
            'controller_name' => 'BeerController',
        ]);
    }
    /**
     * @Route("/shop", name="shop")
     */
    public function shop()
    {
        $beerRepo = $this->getDoctrine()->getRepository(Beer::class);
        $beers = $beerRepo->findAll();
        
        return $this->render('beer/shop.html.twig', [
            'controller_name' => 'BeerController',
            'bieres' => $beers,
        ]);
    }

   /**
     * méthode utilisée pour l'ajout et l'édition  (2 routes)
     * @Route("/beer/new", name="form")
     * @Route("/beer/{id}/edit", name="beer_edit")
     */
    public function form(Request $request, ObjectManager $manager, Beer $Beer = null)
    {
        // méthode utilisée pour l'ajout et l'édition 
        if (!$Beer) {
            $Beer = new Beer();
            $title = "Nouvelle Bière";
        }
        else{
            $title = "Edition de la bière n° ". $Beer->getId();
        }
        // 3ème méthode symfony (la meilleure): 
        // à partir du type de formulaire associé à l'entity Beer
        // par la commande : php bin/console make:form BeerType Beer
        $form = $this->createForm(BeerType::class, $Beer);
        // traitement du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // en création : pas d'id
            if (!$Beer->getId()) {
                $Beer->setSlug(rand());
            }
            // ajout dans la base :
            $manager->persist($Beer);
            $manager->flush();
            // redirection sur la vue de l'Beer
            return $this->redirectToRoute('beer_show', ['id' => $Beer->getId()]);
        }
        return $this->render('beer/form.html.twig', [
            'controller_name' => 'beerController',
            'formBeer' =>  $form->createView(),
            'title' => $title
        ]);
    }

        /**
     * @Route("/beer/show/{id}", name="beer_show")
     */
    public function show(Beer $Beer)
    {
        $title = "Beer";
        return $this->render('beer/show.html.twig', [
            'controller_name' => 'BeerController',
            'biere' => $Beer,
            'title' => $title
        ]);
    }


}

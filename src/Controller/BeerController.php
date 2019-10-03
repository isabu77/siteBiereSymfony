<?php

namespace App\Controller;

use App\Entity\Beer;
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
}
